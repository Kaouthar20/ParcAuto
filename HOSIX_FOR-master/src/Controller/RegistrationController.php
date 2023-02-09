<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\ApptCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, ApptCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {




        return $this->render('registration/register.html.twig');
    }
    #[Route('/register/save', name: 'app_register_save')]
    public function registerSave(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, ApptCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setFullName($request->get('fullname'));
        $user->setUsername($request->get('username'));
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $request->get('plainPassword')
            )
        );
        $user->setRoles(['ROLE_USER']);


        $entityManager->persist($user);
        $entityManager->flush();
        // do anything else you need here, like send an email

        // return $userAuthenticator->authenticateUser(
        //     $user,
        //     $authenticator,
        //     $request
        // );
        return $this->redirectToRoute('app_login');
    }
}
