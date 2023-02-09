<?php

namespace App\Controller;

use App\Entity\User;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home()
    {

        return $this->render('home.html.twig');
    }

    #[Route('/createUser', name: 'create_user')]
    public function createUser(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();

        // $user1 = new User();
        // $user1->setEmail('salma@email.com');
        // $user1->setRoles([]);
        // $user1->setPassword('password');
        // $user1->setPrenom('Salma');
        // $user1->setNom('naji');
        // $user1->setTelephone('0635298741');
        // $user1->setAPropos('some description');
        // $user1->setInstagram('salma_inta');


        // $em->persist($user1);

        // $em->flush();
        // return new Response('Saved new user with id ');
        // $user3 = new User();

        // for ($i = 30; $i < 40; $i++) {
        //     # code...


        //     $user3->setEmail('ismail@email.com' . $i);
        //     $user3->setRoles([$i]);
        //     $user3->setPassword('password' . $i);
        //     $user3->setPrenom('ismail' . $i);
        //     $user3->setNom('ismaili' . $i);
        //     $user3->setTelephone('0635298741' . $i);
        //     $user3->setAPropos('some description' . $i);
        //     $user3->setInstagram('ismail_inta' . $i);


        //     $em->persist($user3);
        // }
        // $em->flush();



        // return new Response('Saved new user with id ');
    }

    #[Route('/user', name: 'app_user')]
    public function UserList(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('user/liste.html.twig', [
            'users' => $users
        ]);
    }
}
