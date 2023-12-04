<?php

namespace App\Controller;

use App\Entity\Evennement;
use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\EvennementRepository;
use App\Repository\ParticipantRepository;
use App\Service\Twilioiheb;
use App\Service\TwilioService;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;






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


  

    #[Route('/{idevent}/barcode', name: 'barcode')]
    public function generateBarcode(EvennementRepository $repo, int $idevent): Response
    {
        $evenement = $this->getDoctrine()->getRepository(Evennement::class)->findOneBy(['idevent' => $idevent]);
        $generator = new BarcodeGeneratorHTML();
        $barcodeContent = strtoupper($evenement->getTitre()) . "-" . strtoupper($evenement->getDescription()) . "-" . strtoupper($evenement->getLieu()) . "-" . strtoupper($evenement->getAdresse());
        $barcode = $generator->getBarcode($barcodeContent, $generator::TYPE_CODE_39);
        return $this->render('participant/testBarcode.html.twig', [
            'barcode' => $barcode,
        ]);
    }


    #[Route('/stats', name: 'stats')]
    public function stat(EvennementRepository $evennementRepository)
    {
        $evenements = $evennementRepository->findAll();
        $lieuxCount = [];
    
        foreach ($evenements as $eve) {
            $lieu = strtolower($eve->getLieu()); // Normaliser la casse (tout en minuscules)
    
            if (isset($lieuxCount[$lieu])) {
                $lieuxCount[$lieu]++;
            } else {
                $lieuxCount[$lieu] = 1;
            }
        }
    
        $lieuData = [];
        foreach ($lieuxCount as $lieu => $count) {
            $lieuData[] = ['lieu' => $lieu, 'nombre' => $count];
        }
    
        return $this->render('participant/stats.html.twig', [
            'lieuData' => json_encode($lieuData),
        ]);
    }
    
    



#[Route('/generateExcel', name: 'excel')]
public function generateExcel(EvennementRepository $evepo): BinaryFileResponse
{
    $evenements = $evepo->findAll();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Titre');
    $sheet->setCellValue('B1', 'Addresse');
    $sheet->setCellValue('C1', 'Lieu');
    $sheet->setCellValue('D1', 'Description');

    $sn = 1;
    foreach ($evenements as $p) {
        $sheet->setCellValue('A' . $sn, $p->getTitre());
        $sheet->setCellValue('B' . $sn, $p->getAdresse());
        $sheet->setCellValue('C' . $sn, $p->getLieu());
        $sheet->setCellValue('D' . $sn, $p->getDescription());

        $sn++;
    }

    $writer = new Xlsx($spreadsheet);

    $fileName = 'evenements.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $fileName);

    $writer->save($temp_file);

    return new BinaryFileResponse($temp_file, 200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => sprintf('inline; filename="%s"', $fileName),
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

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participant);
            $entityManager->flush();

           
        }

        return $this->renderForm('participant/new22.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }

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
public function new222(Request $request, EntityManagerInterface $entityManager, EvennementRepository $eventRepository,int $idevent, Twilioiheb $twilioService): Response
{
    $participant = new Participant();

   
    $eventRepository = $entityManager->getRepository(Evennement::class);
    $evennements = $eventRepository->findAll();
    $Event = $eventRepository->findOneBy(['idevent' => $idevent]);

   
    if ($Event) {
       
        $participant->setEvent($Event);

       
        $form = $this->createForm(ParticipantType::class, $participant);
    } else {
     
        $form = $this->createForm(ParticipantType::class, $participant);
    }

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
        $evennement = $participant->getEvent();
        $entityManager->persist($participant);
        $entityManager->flush();
        $to = '+21650163556';
        $message = 'un participant est ajouté avec succès';
        $twilioService->sendSMS($to, $message);
        $this->addFlash('success', 'Le Participant  a été ajouté a l èvent avec succès.');
        return $this->redirectToRoute('app_participant_new22');
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
}
