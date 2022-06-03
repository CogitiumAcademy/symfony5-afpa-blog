<?php

namespace App\Controller\Admin3;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin3/category', name: 'admin3_category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin3/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addCategory(Request $request, ManagerRegistry $doctrine): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'Catégorie ajoutée !');
            return $this->redirectToRoute('admin3_category_index');
        }
        
        return $this->render('admin3/category/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajout d\'une catégorie',
        ]);    
    }

    #[Route('/update/{id}', name: 'update')]
    public function updateCategory(Category $category, Request $request, ManagerRegistry $doctrine): Response
    {
        //$category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            $this->addFlash('success', 'Catégorie modifiée !');
            return $this->redirectToRoute('admin3_category_index');
        }
        
        return $this->render('admin3/category/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modification d\'une catégorie',
        ]);    
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Category $category, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'Catégorie supprimée !');
        return $this->redirectToRoute('admin3_category_index');
    }
}
