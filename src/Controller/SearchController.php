<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('post_search'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary btn-sm'
                ]
            ])
            ->getForm();

        return $this->render('search/searchbar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/recherche', name: 'post_search')]
    public function handleSearch(Request $request, PostRepository $pr): Response
    {
        $query = $request->request->get('form')['query'];
        //dd(htmlentities($query, ENT_NOQUOTES, 'UTF-8'));
        $posts = $pr->findPostsBySearch($query);

        return $this->render('post/filtre.html.twig', [
            'filter' => 'Recherche',
            'filtervalue' => $query,
            'posts' => $posts
        ]);
    }
}
