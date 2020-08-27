<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrackerController extends AbstractController
{
    /**
     * @Route("/api/tracker", name="tracker")
     */
    public function index()
    {
        return $this->render('tracker/index.html.twig', [
            'controller_name' => 'TrackerController',
        ]);
    }
}
