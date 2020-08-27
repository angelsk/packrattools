<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MockupController extends AbstractController
{
    /**
     * @Route("/api/mockup", name="mockup")
     */
    public function index()
    {
        return $this->render('mockup/index.html.twig', [
            'controller_name' => 'MockupController',
        ]);
    }
}
