<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


#[Route('/avis')]
class AvisController extends AbstractController
{
    #[Route('/', name: 'app_avis_index', methods: ['GET'])]
    public function index(Request $request, AvisRepository $avisRepository): Response
    {
        $date = $request->query->get('date');
    
        if ($date) {
            $avis = $avisRepository->findByDate(new \DateTime($date)); // Supposons que vous avez une méthode findByDate dans votre repository
        } else {
            $avis = $avisRepository->findAll();
        }
    
        return $this->render('avis/index.html.twig', [
            'avis' => $avis,
        ]);
    }
    
    #[Route('/download/excel/avis', name: 'download_excel_avis')]
    public function downloadExcelFromAvis(EntityManagerInterface $entityManager, FlashBagInterface $flashBag): BinaryFileResponse
    {
        // Récupérer les données de la table "avis" depuis la base de données
        $avisRepository = $entityManager->getRepository(Avis::class);
        $avisData = $avisRepository->findAll(); // Vous pouvez adapter cette requête selon vos besoins
            
        // Définir le chemin du répertoire où le fichier sera enregistré
        $directoryPath = 'C:\Users\Ltifi\Downloads\last vers\ihebiheb\Piweb-ihebevent\Piweb';
    
        // Vérifier si le répertoire existe, sinon le créer
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true); // Créer le répertoire avec les permissions nécessaires
        }
    
        // Définir le chemin complet du fichier Excel
        $filePath = $directoryPath . '\fichier_excel_avis.xlsx';
    
        // Créer un écrivain (writer) pour le fichier Excel
        $writer = WriterEntityFactory::createXLSXWriter();
    
        // Vérifier si le fichier existe déjà
        if (!file_exists($filePath)) {
            // Créer un tableau avec les titres des colonnes
            $columnTitles = [
                ['ID', 'Username', 'Titre avis', 'Pub avis', 'Date avis', 'Pub avis', 'Nom restaurant'],
            ];
        
            // Ouvrir le fichier uniquement s'il n'existe pas déjà
            $writer->openToFile($filePath);
            
            foreach ($columnTitles as $columnRow) {
                // Créer une ligne avec les titres de colonnes
                $titleRow = WriterEntityFactory::createRowFromArray($columnRow);
                $writer->addRow($titleRow); // Ajouter la ligne des titres de colonnes
               
            }
            foreach ($avisData as $avis) {
                // Adapter ces lignes en fonction des propriétés de votre entité Avis
                $row = [
                    $avis->getId(),
                    $avis->getUser()->getUsername(),
                    $avis->getTitreavis(),
                    $avis->getPubavis(),
                    $avis->getDateavis()->format('Y-m-d'),
                    $avis->getPubavis(), // Vérifiez si c'est la bonne propriété
                    $avis->getRestaurant()->getNom(),
                ];
        
                $rowEntity = WriterEntityFactory::createRowFromArray($row);
                $writer->addRow($rowEntity);
            }
        
            // Fermer le fichier Excel
            $writer->close();
        }
        if (file_exists($filePath)) {
            $flashBag->add('success', 'Le fichier a été téléchargé avec succès.');
        }
    
        return $this->file($filePath, 'fichier_excel_avis.xlsx');
        
    }
   
    #[Route('/new', name: 'app_avis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avi-> setDateavis (new \DateTime());
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/front', name: 'app_avis_indexFront', methods: ['GET'])]
    public function indexFront(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/indexFront.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }
    #[Route('/new55', name: 'app_avis_new55', methods: ['GET', 'POST'])]
    public function new55(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avi-> setDateavis (new \DateTime());
            $entityManager->persist($avi);
            $entityManager->flush();

           
        }

        return $this->renderForm('avis/new55.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avis_show', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }
    #[Route('rr/{id}', name: 'app_avis_show55', methods: ['GET'])]
    public function showf(Avis $avi): Response
    {
        return $this->render('avis/show55.html.twig', [
            'avi' => $avi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_avis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/editF', name: 'app_avis_editFront', methods: ['GET', 'POST'])]
    public function editf(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_indexFront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/editFront.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('back/{id}', name: 'app_avis_deleteFront', methods: ['POST'])]
    public function deletef(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avis_indexFront', [], Response::HTTP_SEE_OTHER);
    }
   


    
}



