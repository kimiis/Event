<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeProfilController extends AbstractController
{
    #[Route('/home', name: '_home')]
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

//    #[Route('/profil', name: '_profil')]
//    public function profil(): Response
//    {
//        return $this->render('home/profil.html.twig');
//    }
}
