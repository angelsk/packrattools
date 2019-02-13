<?php

namespace App\Controller;

use App\Service\ArtistService;
use App\Service\CollectionService;
use App\Service\FamilyService;
use App\Service\FeatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    /**
     * @var CollectionService
     */
    private $collectionService;

    /**
     * @param CollectionService $collectionService
     */
    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    /**
     * @param ArtistService $artistService
     * @param FeatService $featService
     * @param FamilyService $familyService
     *
     * @Route("/info/", name="info")
     */
    public function index(ArtistService $artistService, FeatService $featService, FamilyService $familyService)
    {
        $gadgets = function (array $a, array $b) {
            return $a['family_id'] === 0; // Put gadgets last
        };

        $families = $familyService->getStatistics();
        $familyCards = $familyService->getCardStatistics();

        usort($families, $gadgets);
        usort($familyCards, $gadgets);

        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
            'collections' => $this->collectionService->getCurrentCollections(),
            'artists' => $artistService->getStatistics(),
            'feats' => $featService->getStatistics(),
            'families' => $families,
            'familyCards' => $familyCards,
            'totalCollections' => array_sum(array_column($families, 'total')),
            'currentCollections' => array_sum(array_column($families, 'current')),
            'totalCards' => array_sum(array_column($familyCards, 'total')),
            'currentCards' => array_sum(array_column($familyCards, 'current')),
        ]);
    }
}
