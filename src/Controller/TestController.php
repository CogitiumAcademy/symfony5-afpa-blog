<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findOldPosts(2);
        dd($posts);


        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/test2/{id}', name: 'app_test2')]
    public function index2(Category $category, CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findCommentsByCategory($category, 20);
        //dd($comments);

        return $this->render('category/test.html.twig', [
            'category' => $category,
            'comments' => $comments,
        ]);
    }
}
