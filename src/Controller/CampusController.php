<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusType;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    #[Route('/campus', name: '_campus')]
    public function Campus(
        Request                $request,
        EntityManagerInterface $entityManager,
        CampusRepository       $campusRepository

    ): Response
    {
        $campus = new Campus();
        $campusForm = $this->createForm(CampusType::class, $campus);
        $campusForm->handleRequest($request);
        if ($campusForm->isSubmitted() && $campusForm->isValid()) {
            $entityManager->persist($campus);
            $entityManager->flush();
        }

        return $this->render('campus/campus.html.twig',
            compact('campusForm')
        );
    }

    #[Route('/tri/{campus}', name: '_tri')]
    public function Tri(
        CampusRepository $campusRepository,
        Campus           $campus

    ): Response
    {
//        $triCampus = $campusRepository->sortByCampus($campus->getName());
        $triCampus = $campusRepository->findBy(
            ['name' => $campus->getName()]
        );
//        return new JsonResponse($triCampus);
        return $this->render('campus/tri.html.twig',
            compact('triCampus')
        );

    }


}
