<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $searchQuery = $request->query->get('q');
    
        if ($searchQuery) {
            // Use the advanced search method if a search query is provided
            $users = $userRepository->advancedSearch($searchQuery);
        } else {
            // Use findAll if no search query is provided
            $users = $userRepository->findAll();
        }
    
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $user->setRole(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/new44', name: 'app_user_new44', methods: ['GET', 'POST'])]
    public function new44(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // Encode the new user's password
        $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
        $user->setRole(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();

           
        }

        return $this->renderForm('user/new44.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/{iduser}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{iduser}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
        // Encode the user's password if it has been changed
        $originalPassword = $form->get('password')->getData();

        if ($form->isSubmitted() && $originalPassword !== $user->getPassword()) {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
        }
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{iduser}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager,): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getIduser(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    

    #[Route('/{iduser}/edit44', name: 'app_user_edit44', methods: ['GET', 'POST'])]
     public function edit44(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
{
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Encode the user's password if it has been changed
        $originalPassword = $form->get('password')->getData();

        if ($form->isSubmitted() && $originalPassword !== $user->getPassword()) {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
        }


        $entityManager->flush();

        return $this->redirectToRoute('home_Front', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('user/edit44.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);
}
#[Route('/tri/{criteria}', name: 'app_user_tri', methods: ['GET'])]
public function tri(UserRepository $userRepository, string $criteria): Response
{
    // Vérifier si le critère de tri est valide
    $validCriteria = ['iduser', 'username', 'email', 'firstname', 'lastname', 'tel', 'address', 'role'];
    
    if (!in_array($criteria, $validCriteria)) {
        throw $this->createNotFoundException('Invalid sorting criteria.');
    }

    // Appeler la méthode de tri dans le repository
    $users = $userRepository->findAllSortedBy($criteria);

    return $this->render('user/index.html.twig', [
        'users' => $users,
        'currentCriteria' => $criteria,
    ]);
}

}