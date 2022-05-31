<?php

namespace App\Controller\Admin3;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin3', name: 'admin3_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('admin3/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
