<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class InscriptionController extends AbstractController
{

    private $passwordEncoder;
    private $em;

    public function __construct(
        UserPasswordHasherInterface $passwordEncoder,
        EntityManagerInterface $em
        )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em=$em;
    }



    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request): Response
    {
        // init depuis requette http
        $firstName= $request->request->get("firstname");
        $lastname = $request->request->get("lastname");
        $password = $request->request->get("password");
        $email = $request->request->get("email");
        // validation et controle de donées 
        if(!empty($firstName) && !empty($lastname) &&!empty($password) &&!empty($email)){
            // crypter le mot de  passe et perssister l'user
            $user = new User();
            $user->setEmail($email)
                 ->setFirstname($firstName)
                 ->setLastname($lastname)
                 ->setRoles(['ROLE_USER'])
                 ->setPassword($this->passwordEncoder->hashPassword($user,$password));    
            
            // save in bdd
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute("app_login");
        }

        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
}
