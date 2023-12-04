<?php


    $sheet->setCellValue('A1', 'Username');
    $sheet->setCellValue('B1', 'Email');
    $sheet->setCellValue('C1', 'Firstname');
    $
  
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
        // Encode the user's password if it has been changed
       
        
            
    
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{iduser}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
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
    $form = $this->createForm(UserTypeEdit::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        


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
#[Route('/searchUserAjax', name: 'app_user_search_ajax', methods: ['GET'])]
public function searchUserAjax(Request $request, UserRepository $userRepository): Response
{
    $searchQuery = $request->query->get('q');

    if (!$searchQuery) {
        return $this->render('user/index.html.twig', ['users' => []]);
    }

    $users = $userRepository->advancedSearch($searchQuery);
    $html = $this->render('user/index.html.twig', ['users' => $users])->getContent();

    return new Response($html);
}
#[Route('/block/{iduser}', name: 'app_user_block', methods: ['GET'])]
public function block(User $user, EntityManagerInterface $entityManager): Response
{
    $user->setIsBlocked(true);
    $user->setEtat("Bloqué");
    $entityManager->flush();

    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
}

#[Route('/unblock/{iduser}', name: 'app_user_unblock', methods: ['GET'])]
public function unblock(User $user, EntityManagerInterface $entityManager): Response
{
    $user->setIsBlocked(false);
    $user->setEtat("Actif");
    $entityManager->flush();

    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
}
#[Route('/{id}/change-status', name: 'app_user_change_status')]
public function changeStatusUser(User $user, UserRepository $userRepository, Swift_Mailer $mailer): Response
{
    if ($user->isIsBlocked()) {
        $user->setIsBlocked(false);
        $status = 'We are glad to inform you that your account has been activated again. You can now access our app and benefit from our services.';
    } else {
        $user->setIsBlocked(true);
        $status = 'We are sorry to inform you that your account has been blocked. You will no longer be able to benefit from our services until later notice.';
    }

    // Send Email
    $message = (new Swift_Message($user->isIsBlocked() ? 'Account Blocked' : 'Account Re-activated'))
       ->setFrom('mohamedyemen.khefacha@esprit.tn')
        ->setTo($user->getEmail())
        ->setBody(
            $this->renderView(
                'user/status_email.html.twig',
                ['status' => $status]
            ),
            'text/html'
        );

    $mailer->send($message);

    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
}

}