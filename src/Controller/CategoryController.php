<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index(Category $category, CategoryRepository $categoryRepository): Response
    {
        //dd($category->getPosts());
        if ($category->getParent() == null) {
            //dd($category);
            $posts = $categoryRepository->findPostsByParentCategory($category);
            //dd($posts);

        } else {
            $posts = $category->getPosts();
        }

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'posts' => $posts
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
