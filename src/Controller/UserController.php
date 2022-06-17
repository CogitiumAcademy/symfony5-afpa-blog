<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        //dd($user);
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $em->flush();
            $this->addFlash('success', 'Modification enregistrée !');
            return $this->redirectToRoute('home');
        }

        return $this->render('user/profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
