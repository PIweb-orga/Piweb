<?php

namespace App\Controller;

use App\Entity\Evennement;
use App\Form\EvennementType;
use App\Repository\EvennementRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evennement')]
class EvennementController extends AbstractController
{
    #[Route('/', name: 'app_evennement_index', methods: ['GET'])]
    public function index(EvennementRepository $evennementRepository): Response
    {   
        return $this->render('evennement/index.html.twig', [
            'evennements' => $evennementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_evennement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evennement = new Evennement();
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('img')->getData();
    
           
            if ($file) {
                $filename = uniqid() . '.' . $file->guessExtension();
    
                // Move the file to the directory where event images are stored
                $file->move(
                    'eventimages',
                    $filename
                );
    
               
                $evennement->setImg($filename);
            }
    
            $entityManager->persist($evennement);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_evennement_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('evennement/new.html.twig', [
            'evennement' => $evennement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_evennement_show', methods: ['GET'])]
    public function show(Evennement $evennement,ParticipantRepository $Rep,int $idevent): Response
    {   $Listparticipants = $Rep->findParticipantsDetailsByEvent2($idevent);
      
        return $this->render('evennement/show.html.twig', [
            'evennement' => $evennement,
            'Listparticipants' => $Listparticipants,
        ]);
    }

    #[Route('/{idevent}/edit', name: 'app_evennement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evennement $evennement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('app_evennement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evennement/edit.html.twig', [
            'evennement' => $evennement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_evennement_delete', methods: ['POST'])]
    public function delete(Request $request, Evennement $evennement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evennement->getIdevent(), $request->request->get('_token'))) {
            $entityManager->remove($evennement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evennement_index', [], Response::HTTP_SEE_OTHER);
    }
}
