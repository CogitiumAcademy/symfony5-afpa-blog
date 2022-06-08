<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index(Category $category): Response
    {
        //dd($category->getPosts());

        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/categorytest/{slug}', name: 'test_category')]
    public function index2(Category $category): Response
    {
        //dd($category->getPosts());
        // $posts = $category->getPosts();
        // foreach ($posts as $post) {
        //     # code...
        // }

        return $this->render('category/test.html.twig', [
            'posts' => $category,
        ]);
    }

}
