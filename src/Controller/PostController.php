<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Entity\Comment;
use App\Form\CommentType;
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
    public function post(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            //dd($comment);

            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->flush();
            // dd($post->slug);
            return $this->redirectToRoute('post_view', array('slug' => $post->getSlug()));
        }

        return $this->render('post/view.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'comments' => $post->getComments(),
        ]);
    }

}
