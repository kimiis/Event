<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\CanceledFormType;
use App\Form\CreateEventFormType;
use App\Repository\EventRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
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
        EventRepository $eventRepository,
        UserRepository  $userRepository,
        Security        $security,



    ): Response
    {

        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);
        $events = $eventRepository->findBy(

            [], //WHERE
            [], //ORDER BY
            10, //LIMIT
            0 //OFFSET -> pagination*/

        );
        return $this->render('listeEvents.html.twig',
            compact('events','user'));
    }

    #[Route('event/detail/{event}', name: '_detail')]
    public function details(
        Event $event,
        UserRepository  $userRepository

    ): Response
    {
        $profils = $userRepository->findBy(
            [], // WHERE
        );
        return $this->render(
            'event_detail/index.html.twig',
            compact('event', 'profils')

        );
    }

    #[Route('/create', name: 'app_create')]
    public function create(
        Request                $request,
        EntityManagerInterface $entityManager,
        Security               $security,
        UserRepository         $userRepository
    ): Response
    {
        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);

        $create = new Event();
        $create->setOrganizer($user);

//        set le select à aujourd'hui
//        $create->setDateD(new \DateTime());
//        $create->setLimiteDate(new \DateTime());

        $createEventForm = $this->createForm(CreateEventFormType::class, $create);
        $createEventForm->handleRequest($request);


        if ($createEventForm->isSubmitted() && $createEventForm->isValid()) {

            $entityManager->persist($create);
            $entityManager->flush();

            return $this->redirectToRoute('app_listeEvents', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('create/index.html.twig', compact('createEventForm'));

    }


    #[Route('/registerEvent/{event}', name: '_registerForEvent')]
    public function registerForEvent(
        EntityManagerInterface $entityManager,
//        EventRepository        $eventRepository,
        Event                  $event,
        UserRepository         $userRepository,
        Security               $security

    ): Response
    {

//        user co
        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);

//add

        if (!$event) {
            throw $this->createNotFoundException('Error 404: page not found');
//si organisateur essaye de participer
        } else if ($event->getOrganizer() === $user) {

            throw $this->createNotFoundException("Error 450: Blocked by Windows Parental Controls");

// Si mon nb maxInsc >= à ma liste de user inscrit de l'event alors
        } else if ($event->getNbMaxInsc() <= $event->getUsers()->count() && !$event->getUsers()->contains($user)) {

            throw $this->createNotFoundException("Error 200: it's ok baby~");

// si status != open
        } else if ($event->getStatus()->getName() !== "Open") {

            throw $this->createNotFoundException("Error 410: Gone");

//         si la date limite est depassé
        } else if ($event->getLimiteDate() < new \DateTime()) {

            throw $this->createNotFoundException("It's too late to apologize, yeaaaaah yeah yeah ~");

//            si l'user n'est pas sur la liste des user de l'event alors
        } else if (!$event->getUsers()->contains($user)) {

            // Ajoutez l'utilisateur à la liste des participants de l'événement
            $event->addUser($user);

        } else {
            $event->removeUser($user);
        }

        $entityManager->persist($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_listeEvents');

    }

//    #[Route('/canceled/{event}/', name: 'app_eventCanceled')]
//    public function eventCanceled(
//        EntityManagerInterface $entityManager,
//        StatusRepository       $statusRepository,
//        Request                $request,
//        Event                  $event
//
//    ): Response
//    {
//        $canceled = $statusRepository->findOneBy(['name' => 'Annulé']);
//        $event->setStatus($canceled);
//
//        $canceledForm = $this->createForm(CanceledFormType::class, $canceled);
//        $canceledForm->handleRequest($request);
//
//        if ($canceledForm->isSubmitted() && $canceledForm->isValid()) {
//
//            $cancellationReason = $canceledForm->get('cancellationReason')->getData();
//            $event->setCancellationReason($cancellationReason);
//
//            $entityManager->persist($event);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_listeEvents', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->redirectToRoute('app_listeEvents', compact('canceledForm'));
//        }
//

}
