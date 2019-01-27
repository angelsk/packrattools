<?php

namespace App\Controller;

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
     * @Route("/info/", name="info")
     */
    public function index()
    {
        $collections = $this->collectionService->getCurrentCollections();

        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
            'collections' => $collections
        ]);
    }
}
