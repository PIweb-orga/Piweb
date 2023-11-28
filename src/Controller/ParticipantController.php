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

use Endroid\QrCode\QrCode;
use Dompdf\Dompdf;

use Dompdf\Options;




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

    // Fetch the events from the repository
    $eventRepository = $entityManager->getRepository(Evennement::class);
    $evennements = $eventRepository->findAll();
    $Event = $eventRepository->findOneBy(['idevent' => $idevent]);

    // Check if the event is not null before accessing its properties
    if ($Event) {
        // Set default values for the form fields
        $participant->setEvent($Event);

        // Create the form with the participant data
        $form = $this->createForm(ParticipantType::class, $participant);
    } else {
        // Handle the case where the event is not found
        // You may want to throw an exception or handle it according to your needs
        // For now, creating an empty form
        $form = $this->createForm(ParticipantType::class, $participant);
    }

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Handle form submission
        $evennement = $participant->getEvent();
    
        // Ensure that the participant ID is a valid string
        $participantId = (string) $participant->getIdparticipant();
    
        // Generate QR Code
        $qrCode = new QrCode($participantId);
        $qrCode->setSize(300);
    
        // Save the QR Code as an image (you can adjust the path)
        $qrCode->writeFile('path/to/qrcodes/qrcode_' . $participantId . '.png');
    
        $entityManager->persist($participant);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_participant_index');
    
    }

    return $this->render('participant/newfront.html.twig', [
        'participant' => $participant,
        'form' => $form->createView(),
        'Event' => $Event,
        'evennement' => $evennements,
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
    #[Route('/pdf', name: 'pdf')]
    public function pdf(Participant $participant,ParticipantRepository $ParticipantRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('participant/pdf.html.twig', [
            'participant' => $ParticipantRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}
