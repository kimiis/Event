<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\CanceledFormType;
use App\Form\CreateEventFormType;
use App\Repository\CampusRepository;
use App\Repository\EventRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Clock\now;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/listeEvents', name: 'app_listeEvents')]
    public function listeEvents(
        EventRepository $eventRepository,
        UserRepository  $userRepository,
        Security        $security,


    ): Response
    {


        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);

        $events = $eventRepository->findRecentEvents();

        return $this->render('listeEvents.html.twig',
            compact('events', 'user'
            ));
    }


    #[Route('event/detail/{event}', name: '_detail')]
    public function details(
        Event          $event,
        UserRepository $userRepository

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
        $create->setDateD(new \DateTime());
        $create->setLimiteDate(new \DateTime());

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

//        je verifie l'event est en open, si la date limite d'inscription est bien après la date actuelle, si le nombre d'inscrit est inférieur au nombre max d'inscription.

        if ($user && $event->getStatus()->getName() !== "Open" || $event->getLimiteDate() < new \DateTime() || $event->getNbMaxInsc() <= $event->getUsers()->count()
            || !$event->getUsers()->contains($user)) {

            $event->addUser($user);

            $entityManager->persist($event);
            $entityManager->flush();

        } else {
            throw $this->createNotFoundException('Error 404: user not found');
        }

////add
//        if (!$event) {
//            throw $this->createNotFoundException('Error 404: page not found');
////si organisateur essaye de participer
//        } else if ($event->getOrganizer() === $user) {
//
//            throw $this->createNotFoundException("Error 450: Blocked by Windows Parental Controls");
//
//// Si mon nb maxInsc >= à ma liste de user inscrit de l'event alors
//        } else if ($event->getNbMaxInsc() <= $event->getUsers()->count() && !$event->getUsers()->contains($user)) {
//
//            throw $this->createNotFoundException("Error 200: it's ok baby~");
//
//// si status != open
//        } else if ($event->getStatus()->getName() !== "Open") {
//
//            throw $this->createNotFoundException("Error 410: Gone");
//
////         si la date limite est depassé
//        } else if ($event->getLimiteDate() < new \DateTime()) {
//
//            throw $this->createNotFoundException("It's too late to apologize, yeaaaaah yeah yeah ~");
//
////
//        }
//            $event->removeUser($user);

        return $this->redirectToRoute('app_listeEvents');

    }

    #[Route('/unRegisterEvent/{event}', name: '_unRegisterForEvent')]
    public function unRegisterForEvent(
        EntityManagerInterface $entityManager,
        Event                  $event,
        UserRepository         $userRepository,
        Security               $security

    ): Response
    {
        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);

        $event->removeUser($user);

        $entityManager->persist($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_listeEvents');
    }

    #[Route('/canceled/{event}/{reason}', name: 'app_eventCanceled')]
    public function eventCanceled(
        EntityManagerInterface $entityManager,
        StatusRepository       $statusRepository,
        Event                  $event,
        UserRepository         $userRepository,
        Security               $security,
        string                 $reason

    ): Response
    {

        $user = $userRepository->findOneBy(["email" => $security->getUser()->getUserIdentifier()]);
        if ($event->getOrganizer() === $user) {

            $canceled = $statusRepository->findOneBy(['id' => '5']);
            $event->setStatus($canceled);
            $event->setCancellationReason($reason);
//je met à jour le status
            $entityManager->persist($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_listeEvents', [], Response::HTTP_SEE_OTHER);
    }




}
