<?php

namespace App\Controller\Admin3;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin3/post', name: 'admin3_post_')]
class PostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('admin3/post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addPost(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $post->setActive(true);
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Article ajouté !');
            return $this->redirectToRoute('admin3_post_index');
        }
        
        return $this->render('admin3/post/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajout d\'un article',
        ]);    
    }

    #[Route('/update/{id}', name: 'update')]
    public function updatePost(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            $this->addFlash('success', 'Article modifié !');
            return $this->redirectToRoute('admin3_post_index');
        }
        
        return $this->render('admin3/post/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modification d\'un article',
        ]);    
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Post $post, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();
        $this->addFlash('success', 'Article supprimé !');
        return $this->redirectToRoute('admin3_post_index');
    }

    #[Route('/activate/{id}', name: 'activate')]
    public function activate(Post $post, ManagerRegistry $doctrine): Response
    {
        $post->setActive(($post->getActive()) ? false : true);
        $em = $doctrine->getManager();
        $em->flush();
        return new Response("true");
    }

}
