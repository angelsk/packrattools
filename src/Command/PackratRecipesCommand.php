<?php

namespace App\Command;

use App\Service\PackratApi;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PackratRecipesCommand extends Command
{
    protected static $defaultName = 'packrat:recipes';

    private PackratApi $packratApi;

    private EntityManagerInterface $entityManager;

    public function __construct(PackratApi $packratApi, EntityManagerInterface $entityManager)
    {
        $this->packratApi = $packratApi;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Process recipes from the Packrat API for the special collections');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $collectionApiId = 943; // Hardcoded for 900th

        $collection = $this->packratApi->getCollection($collectionApiId);
        $dbCollection = $this->getCollectionFromDatabase($collectionApiId);
        $collectionIds = [];

        $io->success('Found collection: ' . $collection['name']);

        foreach ($collection['cards'] as $packratCardId) {
            $card = $this->packratApi->getCard($packratCardId);
            $dbCard = $this->getCardFromDatabase($packratCardId);

            $recipe = [];
            $relatedCollectionIds = [$dbCollection['collection_id']];

            if (isset($card['recipe'])) {
                foreach ($card['recipe'] as $packratRecipeId) {
                    try {
                        $recipeCard = $this->packratApi->getCard($packratRecipeId);
                    } catch (RequestException $exception) {
                        // Not found
                        $recipeCard = [];
                    }
                    $dbRecipeCard = $this->getCardFromDatabase($packratRecipeId);

                    if (empty($recipeCard) && empty($dbRecipeCard)) {
                        break;
                    }

                    $recipeCollection = $this->getCollectionFromDatabase($recipeCard['collection_id']);
                    $recipe[] = [
                        'api' => $recipeCard,
                        'db' => $dbRecipeCard,
                        'collection' => $recipeCollection,
                    ];
                    $relatedCollectionIds[] = $recipeCollection['collection_id'];
                }
            }

            if (3 !== count($recipe)) {
                $io->error('[ERROR] Missing recipe for ' . $dbCard['card_name']);
                continue;
            }

            $io->block(
                sprintf(
                    'INSERT INTO card_recipe (card_id, ingredient_1, ingredient_2, ingredient_3) VALUES (%d, %d, %d, %d);',
                    $dbCard['card_id'],
                    $recipe[0]['db']['card_id'],
                    $recipe[1]['db']['card_id'],
                    $recipe[2]['db']['card_id']
                )
            );

            $tweet = sprintf(
                "New recipe: %s (%s, %d points) = %s (%s) + %s (%s) + %s (%s) #packrat",
                $dbCard['card_name'],
                $dbCollection['collection_name'],
                $dbCard['point_value'],
                $recipe[0]['db']['card_name'],
                $recipe[0]['collection']['collection_name'],
                $recipe[1]['db']['card_name'],
                $recipe[1]['collection']['collection_name'],
                $recipe[2]['db']['card_name'],
                $recipe[2]['collection']['collection_name']
            );

            if (strlen($tweet) > 280) {
                $io->error('Tweet too long');
            }

            $io->block(
                sprintf(
                    'INSERT INTO queue (type, tweet) VALUES ("new_recipe", "%s");',
                    $tweet
                )
            );

            $collectionIds = array_merge($collectionIds, $relatedCollectionIds);

            foreach ($recipe as $ing) {
                $collection = $ing['collection'];
                $related = [];

                if (isset($collection['related_collection_id']) && $collection['related_collection_id'] !== '0') {
                    $related = explode(',', $collection['related_collection_id']);
                }

                $related = array_unique(array_merge($related, $relatedCollectionIds));
                $related = array_diff($related, [$collection['collection_id']]);

                $io->block(
                    sprintf(
                        'UPDATE collection SET related_collection_id = "%s" WHERE collection_id = %d;',
                        implode(',', $related),
                        $collection['collection_id']
                    )
                );
            }
        }

        $io->block(
            sprintf(
                'UPDATE collection SET related_collection_id = "%s" WHERE collection_id = %d;',
                implode(',', array_unique($collectionIds)),
                $dbCollection['collection_id']
            )
        );
    }

    private function getCollectionFromDatabase(int $packratId): array
    {
        $conn = $this->entityManager->getConnection();

        $sql = '
            SELECT * FROM collection c
            WHERE c.packrat_id = :packrat_id
        ';
        $stmt = $conn->prepare($sql);
        return $stmt->executeQuery(['packrat_id' => $packratId])->fetchAssociative();
    }

    private function getCardFromDatabase(int $packratId): array
    {
        $conn = $this->entityManager->getConnection();

        $sql = '
            SELECT * FROM card c
            WHERE c.packrat_id = :packrat_id
        ';
        $stmt = $conn->prepare($sql);
        return $stmt->executeQuery(['packrat_id' => $packratId])->fetchAssociative();
    }
}
