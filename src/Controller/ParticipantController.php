<?php

namespace App\Controller;

use App\Entity\Evennement;
use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\EvennementRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participant')]
class ParticipantController extends AbstractController
{
    #[Route('/', name: 'app_participant_index', methods: ['GET'])]
    public function index(ParticipantRepository $participantRepository): Response
    {
        return $this->render('participant/index.html.twig', [
            'participants' => $participantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('app_participant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participant/new.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }
    #[Route('/new22', name: 'app_participant_new22', methods: ['GET', 'POST'])]
public function new22(Request $request, EntityManagerInterface $entityManager): Response
{
    $participant = new Participant();
   
    $form = $this->createForm(ParticipantType::class, $participant);
    $form->handleRequest($request);
   
    // Fetch the events from the repository
    $eventRepository = $entityManager->getRepository(Evennement::class);
    $evennements = $eventRepository->findAll();

    if ($form->isSubmitted() && $form->isValid()) {
        $evennement = $participant->getEvent();
        $entityManager->persist($participant);
        $entityManager->flush();
    }

    return $this->renderForm('participant/new22.html.twig', [
        'participant' => $participant,
        'form' => $form,
        'evennement' => $evennements, // Pass the events to the template
    ]);
}
#[Route('/{idevent}/new222', name: 'app_participant_new222', methods: ['GET', 'POST'])]
public function new222(Request $request, EntityManagerInterface $entityManager, EvennementRepository $eventRepository,int $idevent): Response
{
    $participant = new Participant();
    
    $form = $this->createForm(ParticipantType::class, $participant);
    $form->handleRequest($request);
   
    // Fetch the events from the repository
    $eventRepository = $entityManager->getRepository(Evennement::class);
    $evennements = $eventRepository->findAll();
    $Event=$eventRepository->find($idevent);
    if ($form->isSubmitted() && $form->isValid()) {
        $evennement = $participant->getEvent();
        $entityManager->persist($participant);
        $entityManager->flush();
    }

    return $this->renderForm('participant/newfront.html.twig', [
        'participant' => $participant,
        'form' => $form,
        'Event' => $Event,
        'evennement' => $evennements, // Pass the events to the template
    ]);
}


    #[Route('/{idparticipant}', name: 'app_participant_show', methods: ['GET'])]
    public function show(Participant $participant): Response
    {   
        return $this->render('participant/show.html.twig', [
            'participant' => $participant,
        ]);
    }

    #[Route('/{idparticipant}/edit', name: 'app_participant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participant $participant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participant/edit.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }

    #[Route('/{idparticipant}', name: 'app_participant_delete', methods: ['POST'])]
    public function delete(Request $request, Participant $participant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participant->getIdparticipant(), $request->request->get('_token'))) {
            $entityManager->remove($participant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participant_index', [], Response::HTTP_SEE_OTHER);
    }
}
