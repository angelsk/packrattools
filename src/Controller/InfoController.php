<?php

namespace App\Controller;

use App\Entity\Collection;
use App\Service\ArtistService;
use App\Service\CollectionService;
use App\Service\FamilyService;
use App\Service\FeatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param Request $request
     * @param ArtistService $artistService
     * @param FeatService $featService
     * @param FamilyService $familyService
     *
     * @Route("/info/", name="info")
     */
    public function index(
        Request $request,
        ArtistService $artistService,
        FeatService $featService,
        FamilyService $familyService
    ) {
        // @TODO: Handle redirects better
        if ($request->query->has('collection')) {
            return $this->redirectToRoute(
                'collection',
                ['identifier' => $request->query->get('collection')],
                Response::HTTP_PERMANENTLY_REDIRECT
            );
        }

        $gadgets = function (array $first) {
            return $first['family_id'] === 0; // Put gadgets last
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

    /**
     * @Route("/info/collection/{identifier}", name="collection")
     */
    public function collection(Collection $collection)
    {
        return $this->render('info/collection.html.twig', [
            'controller_name' => 'InfoController',
            'collection' => $collection,
            'prevCollection' => $this->collectionService->getOneById($collection->getId() - 1),
            'nextCollection' => $this->collectionService->getOneById($collection->getId() + 1),
        ]);
    }
}
