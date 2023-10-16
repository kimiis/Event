<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    #[Route('/profil', name: '_profil')]
    public function modifyProfile(
        Request                $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository

    ): Response
    {
        // 1 : Créer une instance
        $modifyProfile = $this->getUser();
        // 2 : Créer une instance du formulaire
        $modifyProfileForm = $this->createForm(UserProfileFormType::class, $modifyProfile);
        // 3 : Envoyer le formulaire au twig
        $modifyProfileForm->handleRequest($request);
        if ($modifyProfileForm->isSubmitted() && $modifyProfileForm->isValid()) {
            $entityManager->persist($modifyProfile);
            $entityManager->flush();

            return $this->redirectToRoute('_profil');
        }


        return $this->render(
            'profil/profil.html.twig',
            compact('modifyProfileForm')
        );
    }
}
