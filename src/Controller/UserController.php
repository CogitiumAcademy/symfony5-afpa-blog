<?php

namespace App\Controller;

use App\Form\PassType;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    #[IsGranted('ROLE_USER')]
    #[Route('/password', name: 'app_password')]
    public function password(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        
        $form = $this->createForm(PassType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // On vérifie que l'ancien mot de passe est correct
            $oldPassword = $form->get('oldPassword')->getData();
            if (!$userPasswordHasher->isPasswordValid($user, $oldPassword)) {

                // On redirige sur le même form avec un feedback
                $this->addFlash('danger', 'Mot de passe actuel erroné !');
                return $this->redirectToRoute('app_password');
            }

            // On hash le nouveau mot de passe
            $encodedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            // On le stocke dans l'instance user
            $user->setPassword($encodedPassword);

            // On update le user dans la BD
            $em = $doctrine->getManager();
            $em->flush();

            // On redirige vers homme avec feedback
            $this->addFlash('success', 'Mot de passe modifié !');
            return $this->redirectToRoute('home');
        }

        return $this->render('user/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
