<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126221713 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // check we have all the related collections added properly
        $statement = $this->connection->prepare('SELECT DISTINCT r.recipe_id, c.collection_id AS collection, i1.collection_id AS i1, i2.collection_id AS i2, i3.collection_id AS i3 FROM card_recipe r LEFT JOIN card c ON c.card_id = r.card_id LEFT JOIN card i1 ON i1.card_id = r.ingredient_1 LEFT JOIN card i2 ON i2.card_id = r.ingredient_2 LEFT JOIN card i3 ON i3.card_id = r.ingredient_3 WHERE c.collection_id != i1.collection_id OR c.collection_id != i2.collection_id OR c.collection_id != i3.collection_id');
        $statement->execute();
        $results = $statement->fetchAll();

        foreach ($results as $resultRow) {
            $collectionIds = [];
            $collectionIds[$resultRow['collection']] = $resultRow['collection'];
            $collectionIds[$resultRow['i1']] = $resultRow['i1'];
            $collectionIds[$resultRow['i2']] = $resultRow['i2'];
            $collectionIds[$resultRow['i3']] = $resultRow['i3'];

            foreach ($collectionIds as $primaryId) {
                foreach ($collectionIds as $secondaryId) {
                    if ($primaryId != $secondaryId) {
                        $this->addSql(
                            sprintf('INSERT IGNORE INTO related_collections VALUES (%d, %s)', $primaryId, $secondaryId)
                        );
                    }
                }
            }
        }
    }

    public function down(Schema $schema) : void
    {
        // nothing here
    }
}
