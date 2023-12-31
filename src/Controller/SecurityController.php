<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Repository\UserRepository;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;;


class SecurityController extends AbstractController
{
    private $tokenGenerator;

  
    #[Route('/security', name: 'app_security')]
    public function index(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, TokenGeneratorInterface $tokenGenerator): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
         
        // Check if there's a token parameter in the request
        $token = $request->query->get('token');
    
        // Check if the token is valid and not expired
        if ($token) {
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);
    
            if ($user && !$user->isTokenExpired()) {
                // Perform any additional actions with the user or token as needed
                // ...
    
                // Clear the token after processing
                $user->setResetToken(null);
                $user->setStatus('Connected');
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
    
                $this->addFlash('success', 'Password reset successful. You can now log in with your new password.');
            } else {
                $this->addFlash('danger', 'Invalid or expired reset token.');
            }
        } else {
            // If no token is present, generate a new token
            $user = $this->getUser();
    
            if ($user instanceof User) {
                
    
                $token = $tokenGenerator->generateToken();
    
                // Set the generated token in the user entity
                $user->setResetToken($token);
    
                // Persist the changes to the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }
    
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {   
        return $this->redirectToRoute("app_login");
    }


    #[Route(path: '/forgot', name: 'forgot')]
    public function forgotPassword(Request $request, UserRepository $userRepository,Swift_Mailer $mailer, TokenGeneratorInterface  $tokenGenerator)
    {

        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();//


            $user = $userRepository->findOneBy(['email'=>$donnees]);
            if(!$user) {
                $this->addFlash('danger','cette adresse n\'existe pas');
                return $this->redirectToRoute("forgot");

            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManger = $this->getDoctrine()->getManager();
                $entityManger->persist($user);
                $entityManger->flush();




            }catch(\Exception $exception) {
                $this->addFlash('warning','une erreur est survenue :'.$exception->getMessage());
                return $this->redirectToRoute("app_login");


            }

            $url = $this->generateUrl('app_reset_password',array('token'=>$token),UrlGeneratorInterface::ABSOLUTE_URL);

            //BUNDLE MAILER
            $message = (new Swift_Message('Mot de password oublié'))
                ->setFrom('mohamedyemen.khefacha@esprit.tn')
                ->setTo($user->getEmail())
                ->setBody("<p> Bonjour</p> unde demande de réinitialisation de mot de passe a été effectuée. Veuillez cliquer sur le lien suivant :".$url,
                "text/html");

            //send mail
            $mailer->send($message);
            $this->addFlash('message','E-mail  de réinitialisation du mp envoyé :');
        //    return $this->redirectToRoute("app_login");



        }

        return $this->render("security/forgotPassword.html.twig",['form'=>$form->createView()]);
    }


    
    #[Route(path: '/resetpassword/{token}', name: 'app_reset_password')]
    public function resetpassword(Request $request,string $token, UserPasswordEncoderInterface  $passwordEncoder)
    {   $user = $this->getUser();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token'=>$token]);

        if($user == null ) {
            $this->addFlash('danger','TOKEN INCONNU');
            return $this->redirectToRoute("app_login");

        }

        if($request->isMethod('POST')) {
            $user->setResetToken(null);

            $user->setPassword($passwordEncoder->encodePassword($user,$request->request->get('password')));
            $entityManger = $this->getDoctrine()->getManager();
            $entityManger->persist($user);
            $entityManger->flush();

            $this->addFlash('message','Mot de passe mis à jour :');
            return $this->redirectToRoute("app_login");

        }
        else {
            return $this->render("security/resetPassword.html.twig",['token'=>$token]);

        }
    }
    #[Route(path: '/generate_and_redirect', name: 'generate_and_redirect')]
    public function generateAndRedirectAction(TokenGeneratorInterface $tokenGenerator): Response
    {
        $user = $this->getUser();
    
        if ($user instanceof User) {
            // Generate a new token
            $token = $tokenGenerator->generateToken();
    
            // Set the generated token in the user entity
            $user->setResetToken($token);
    
            // Persist the changes to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
    
            // Redirect to the reset password page with the generated token
            return $this->redirectToRoute('app_reset_password', ['token' => $user->getResetToken()]);
        }
    
        // Handle the case where the user is not authenticated
        return $this->redirectToRoute('home_Front');
    }
    
}
