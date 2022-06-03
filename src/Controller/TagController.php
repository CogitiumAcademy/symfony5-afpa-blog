<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController
{
    #[Route('/tag/{slug}', name: 'app_tag')]
    public function index(Tag $tag): Response
    {
        return $this->render('tag/index.html.twig', [
            'tag' => $tag,
        ]);
    }
}
