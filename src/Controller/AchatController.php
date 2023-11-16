<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Plat;
use App\Form\AchatType;
use App\Form\PanierType;
use App\Repository\AchatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/achat')]
class AchatController extends AbstractController
{
    #[Route('/', name: 'app_achat_index', methods: ['GET'])]
    public function index(AchatRepository $achatRepository): Response
    {
        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_achat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/new.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }
    #[Route('/new33', name: 'app_achat_new33', methods: ['GET', 'POST'])]
    public function new33(Request $request, EntityManagerInterface $entityManager): Response
    {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($achat);
            $entityManager->flush();

          
        }

        return $this->renderForm('achat/new33.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{idachat}', name: 'app_achat_show', methods: ['GET'])]
    public function show(Achat $achat): Response
    {
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    #[Route('/{idachat}/edit', name: 'app_achat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achat $achat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/edit.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{idachat}', name: 'app_achat_delete', methods: ['POST'])]
    public function delete(Request $request, Achat $achat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getIdachat(), $request->request->get('_token'))) {
            $entityManager->remove($achat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
    }
   
   /* #[Route('/ajouterAuPanier/{id}', name: 'ajouter_au_panier', methods: ['GET', 'POST'])]
    public function ajouterAuPanier(Request $request, Plat $plat): Response
    {
        $achat = new Achat();
        $achat->setPlat($plat);
    
        $form = $this->createForm(PanierType::class, $achat);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Assuming you have a method like calculateTotalAmount in the Achat entity
            $montantTotal = $achat->calculateTotalAmount();
            $achat->setMontanttotal($montantTotal);
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($achat);
            $entityManager->flush();
    
            $this->addFlash('success', 'Plat ajouté au panier avec succès!');
    
            return $this->redirectToRoute('panier/panier_affichage.html.twig');
        }
    
        return $this->render('panier/create_panier.html.twig', [
            'form' => $form->createView(),
        ]);*/
    }
    

    

    


