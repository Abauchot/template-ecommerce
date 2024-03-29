<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/inscription', name: 'app_register')]
    public function index(Request $requestFormRequest, UserPasswordHasherInterface $hasher): Response
    {
        //instance user & instance view for from
        $user = new User();
        $formRegister = $this->createForm(RegisterType::class,$user);

        //traitement form
        $formRegister->handleRequest($requestFormRequest);
        if($formRegister->isSubmitted() && $formRegister->isValid()){
            $user = $formRegister->getData();
            $password = $hasher->hashPassword($user,$user->getPassword()) ;
            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }


        return $this->render('register/index.html.twig', [
            'formRegister' => $formRegister->createView()
        ]);
    }
}
