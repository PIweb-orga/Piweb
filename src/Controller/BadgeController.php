<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Form\BadgeType;
use App\Repository\BadgeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/badge')]
class BadgeController extends AbstractController
{
    #[Route('/', name: 'app_badge_index', methods: ['GET'])]
    public function index(Request $request, BadgeRepository $badgeRepository, PaginatorInterface $paginator): Response
    {
        $query = $badgeRepository->createQueryBuilder('b')
            ->orderBy('b.datebadge', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query, // Requête à paginer
            $request->query->getInt('page', 1), // Numéro de la page, 1 par défaut
            2 // Nombre d'éléments par page
        );

        return $this->render('badge/index.html.twig', [
            'badges' => $pagination,
        ]);
    }


    #[Route('frontbadge/', name: 'app_badge_indexFront', methods: ['GET'])]
    public function indexf(BadgeRepository $badgeRepository): Response
    {
        return $this->render('badge/indexFront.html.twig', [
            'badges' => $badgeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_badge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $badge-> setDatebadge (new \DateTime());
            $entityManager->persist($badge);
            $entityManager->flush();

            return $this->redirectToRoute('app_badge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('badge/new.html.twig', [
            'badge' => $badge,
            'form' => $form,
        ]);
    }

   // public function br(Request $request, PaginatorInterface $paginator): Response
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    
    //     $query = $entityManager->getRepository(Badge::class)->createQueryBuilder('b')
    //         ->orderBy('b.datebadge', 'DESC')
    //         ->getQuery();
    
    //     $pagination = $paginator->paginate(
    //         $query,
    //         $request->query->getInt('page', 1),
    //         10
    //     );
    
    //     return $this->render('badge/index.html.twig', [
    //         'rap' => $pagination, // Utilisation de 'ppp' au lieu de 'badges'
    //     ]);
    // }
    
    #[Route('/new66', name: 'app_badge_new66', methods: ['GET', 'POST'])]
    public function new66(Request $request, EntityManagerInterface $entityManager): Response
    {
        $badge = new Badge();
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $badge-> setDatebadge (new \DateTime());
            $entityManager->persist($badge);
            $entityManager->flush();

         
        }

        return $this->renderForm('badge/new66.html.twig', [
            'badge' => $badge,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_badge_show', methods: ['GET'])]
    public function show(Badge $badge): Response
    {
        return $this->render('badge/show.html.twig', [
            'badge' => $badge,
        ]);
    }
    #[Route('sh/{id}', name: 'app_badge_show66', methods: ['GET'])]
    public function showFr(Badge $badge): Response
    {
        return $this->render('badge/show66.html.twig', [
            'badge' => $badge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_badge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Badge $badge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_badge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('badge/edit.html.twig', [
            'badge' => $badge,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/editFront', name: 'app_badge_editFront', methods: ['GET', 'POST'])]
    public function editFront(Request $request, Badge $badge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BadgeType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_badge_indexFront', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('badge/editFront.html.twig', [
            'badge' => $badge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_badge_delete', methods: ['POST'])]
    public function delete(Request $request, Badge $badge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badge->getId(), $request->request->get('_token'))) {
            $entityManager->remove($badge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_badge_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('badgef/{id}', name: 'app_badge_deleteFront', methods: ['POST'])]
    public function deleteFront(Request $request, Badge $badge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badge->getId(), $request->request->get('_token'))) {
            $entityManager->remove($badge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_badge_indexFront', [], Response::HTTP_SEE_OTHER);
    }
    // YourController.php
    // public function br(Request $request, PaginatorInterface $paginator): Response
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    
    //     $query = $entityManager->getRepository(Badge::class)->createQueryBuilder('b')
    //         ->orderBy('b.datebadge', 'DESC')
    //         ->getQuery();
    
    //     $pagination = $paginator->paginate(
    //         $query,
    //         $request->query->getInt('page', 1),
    //         10
    //     );
    
    //     return $this->render('badge/index.html.twig', [
    //         'rap' => $pagination, // Utilisation de 'ppp' au lieu de 'badges'
    //     ]);
    // }
    
}