<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\CommentType;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PostRepository $postRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository): Response
    {
        $posts = $postRepository->findLastPosts(10);
        $oldPosts = $postRepository->findOldPosts();
        $randomPhotos = $postRepository->findRandomPhotos();
        $categories = $categoryRepository->findBy(
            array(),
            ['name' => 'ASC']);
        $tags = $tagRepository->findBy(
            array(),
            ['name' => 'ASC']);
    
        return $this->render('post/home.html.twig', [
            'posts' => $posts,
            'oldPosts' => $oldPosts,
            'randomPhotos' => $randomPhotos,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    #[Route('/photo/{slug}', name: 'post_view')]
    public function post(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $post->setViews($post->getViews() + 1);
        $em->flush();

        $isliked = false;
        if ($this->getUser() != null) {
            $likes = $post->getLikedbyusers();
            foreach ($likes as $like) {
                if ($like->getId() == $this->getUser()->getId()) {
                    $isliked = true;
                    //dump("true");
                } 
            }
        }
        //dd("stop");

        // Traitement du formulaire pour ajouter un commentaire
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Associer le user connecté
            $comment->setUser($this->getUser());

            // Associer le post concerné
            $comment->setPost($post);

            // Persister le commentaire
            $em->persist($comment);
            $em->flush();

            // Rediriger vers la même page, grâce au slug
            return $this->redirectToRoute('post_view', array('slug' => $post->getSlug()));
        }

        return $this->render('post/view.html.twig', [
            // Passer l'article à la vue
            'post' => $post,

            // Passer le formulaire à la vue
            'form' => $form->createView(),

            // Like
            'isliked' => $isliked
        ]);
    }

    #[Route('/categorie/{slug}', name: 'post_category')]
    public function postsCatgory(Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($category->getParent() == null) {
            $posts = $categoryRepository->findPostsByParentCategory($category);
        } else {
            $posts = $category->getPosts();
        }

        return $this->render('post/filtre.html.twig', [
            'filter' => 'Catégorie',
            'filtervalue' => $category->getName(),
            'posts' => $posts
        ]);
    }

    #[Route('/tag/{slug}', name: 'post_tag')]
    public function postsTag(Tag $tag): Response
    {
        return $this->render('post/filtre.html.twig', [
            'filter' => 'Tag',
            'filtervalue' => $tag->getName(),
            'posts' => $tag->getPosts(),
        ]);
    }

    #[Route('/photographe/{displayname}', name: 'post_photographer')]
    public function postsPhotographer(User $user): Response
    {
        return $this->render('post/filtre.html.twig', [
            'filter' => 'Photographe',
            'filtervalue' => $user->getDisplayname(),
            'posts' => $user->getPosts(),
        ]);
    }

    #[Route('/post/like/{id}', name: 'post_like')]
    public function postLike(Post $post, ManagerRegistry $doctrine): Response
    {
        $post->addLikedbyuser($this->getUser());
        $em = $doctrine->getManager();
        $em->flush();
        return new Response("true");
    }

    #[IsGranted('ROLE_USER')]
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
    
}
