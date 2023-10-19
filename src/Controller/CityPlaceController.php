<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Place;
use App\Form\CityType;
use App\Form\PlaceType;
use App\Repository\CityRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityPlaceController extends AbstractController
{
    #[Route('/city', name: '_city')]
    public function City(
        Request $request,
        EntityManagerInterface $entityManager,
        CityRepository $cityRepository,


    ): Response
    {
        $city = new City();
        $cityForm = $this->createForm(CityType::class, $city);
        $cityForm -> handleRequest($request);
        if ($cityForm ->isSubmitted()&&$cityForm->isValid()){
            $entityManager->persist($city);
            $entityManager->flush();
        }

        return $this->render('city_place/city.html.twig',
            compact('cityForm')
        );
    }

    #[Route('/place', name: '_place')]
    public function Place(
        Request $request,
        EntityManagerInterface $entityManager,
        PlaceRepository $placeRepository

    ): Response
    {
        $place = new Place();
        $placeForm = $this->createForm(PlaceType::class, $place);
        $placeForm -> handleRequest($request);
        if ($placeForm ->isSubmitted()&&$placeForm->isValid()){
            $entityManager->persist($place);
            $entityManager->flush();
        }

        return $this->render('city_place/place.html.twig',
            compact('placeForm')
        );
    }
}
