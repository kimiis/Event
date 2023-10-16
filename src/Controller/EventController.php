<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\CreateEventFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/listeEvents', name: 'app_listeEvents')]
    public function listeEvents(
        EventRepository $sortieRepository
    ): Response
    {
        $events = $sortieRepository->findBy(

            [], //WHERE
            [], //ORDER BY
            10, //LIMIT
            0 //OFFSET -> pagination*/

        );
        return $this->render('listeEvents.html.twig', compact('events'));
    }

    #[Route('event/detail/{event}', name: '_detail')]
    public function details(Event $event): Response
    {
        return $this->render(
            'event_detail/index.html.twig',
            compact('event')

        );
    }

    #[Route('/create', name: 'app_create')]
    public function create(
        Request                $request,
        EntityManagerInterface $entityManager,
        Security               $security
    ): Response
    {

        $create = new Event();
//        set le select à aujourd'hui
        $create->setDateD(new \DateTime());
        $create->setLimiteDate(new \DateTime());
        $createEventForm = $this->createForm(CreateEventFormType::class, $create);
        $createEventForm->handleRequest($request);


        if ($createEventForm->isSubmitted() && $createEventForm->isValid()) {

            $entityManager->persist($create);
            $entityManager->flush();
            $this->addFlash('success', 'The event has been successfully created and released.');

            return $this->redirectToRoute('app_listeEvents', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('create/index.html.twig', compact('createEventForm'));

    }
    #[Route('/participate', name: '_participate')]
    public function participate(
        EntityManagerInterface $entityManager,
        Event $event
    ): Response
    {

        $entityManager->persist($event);
        $entityManager->flush();

        $this->addFlash('success', $event->getName() . 'has been' .

        $event-> getNbMaxInsc()? 'added' : 'removed' . 'from the event');

        return $this->render(
            'event_detail/index.html.twig',
            compact('event')

        );
    }



}
