<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Component\Mime\Email;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('cogitium@gmail.com')
            ->to('phgiraud@cogitium.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        return $this->render('page/contact.html.twig', [
            'controller_name' => 'PageController',
        ]);

    }

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

    #[Route('/test3', name: 'app_test3')]
    public function index3(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        //dd($comments);

        return $this->render('test/test3.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/test4/{slug}', name: 'app_test4')]
    public function index4(Category $category, CategoryRepository $categoryRepository): Response
    {
        $posts = $categoryRepository->findPostsByParentCategory($category);

        foreach ($posts as $post) {
            dump($post);
        }

        dd('fin');

        return $this->render('test/test3.html.twig', [
            // 'posts' => $posts,
        ]);
    }

    #[Route('/test5', name: 'app_test5')]
    public function index5(): Response
    {
        $user = $this->getUser();
        dump($user);

        $user->setRoles(['ROLE_TEST']);
        dump($user);


        dd('fin');

        return $this->render('test/test3.html.twig', [
            // 'posts' => $posts,
        ]);
    }

    #[Route('/test6', name: 'app_test6')]
    public function index6(CategoryRepository $categoryRepository): Response
    {
        //$categories = $categoryRepository->findAll();
        $categories = $categoryRepository->findBy([], array('name' => 'ASC'));
        //dd($categories);

        //dd('fin');

        return $this->render('test/test6.html.twig', [
            'categories' => $categories,
        ]);
    }
}
