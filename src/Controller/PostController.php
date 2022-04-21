<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PostRepository $postRepository): Response
    {
        //$posts = $postRepository->findAll();
        $posts = $postRepository->findLastPosts();
        //dd($posts);
        $oldPosts = $postRepository->findOldPosts();
        //dd($oldPosts);

        return $this->render('post/home.html.twig', [
            'posts' => $posts,
            'oldPosts' => $oldPosts,
        ]);
    }

    #[Route('/post/add', name: 'post_add')]
    public function addPost(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $post->setActive(false);

            //$em = $this->getDoctrine()->getManager();
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/post/{slug}', name: 'post_view')]
    public function post(Post $post): Response
    {
        return $this->render('post/view.html.twig', [
            'post' => $post
        ]);
    }

}
