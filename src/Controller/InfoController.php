<?php

namespace App\Controller;

use App\Service\ArtistService;
use App\Service\CollectionService;
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
     *
     * @Route("/info/", name="info")
     */
    public function index(ArtistService $artistService)
    {
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
            'collections' => $this->collectionService->getCurrentCollections(),
            'artists' => $artistService->getArtists(),
            'stats' => $this->collectionService->getStatistics(),
            'families' => []
        ]);
    }
}
