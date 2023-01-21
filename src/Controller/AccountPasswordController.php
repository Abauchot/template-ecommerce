<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/compte/motdepasse', name: 'app_account_password')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        //instance loggedUser & view for form
        $notification = null;
        $user = $this->getUser();
        $formChangePassword = $this->createForm(ChangePasswordType::class,$user);

        //handling form

        $formChangePassword->handleRequest($request);
        if($formChangePassword->isSubmitted() && $formChangePassword->isValid()){
            $oldPassword = $formChangePassword->get('old_password')->getData();
            if($hasher->isPasswordValid($user,$oldPassword)){
                $newPassword = $formChangePassword->get('new_password')->getData();
                $password = $hasher->hashPassword($user,$newPassword);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification="votre mot de passe a bien été mis à jour";
            } else{
                $notification = "Votre mot de passe actuel ne correspond pas";
            }
        }


        return $this->render('account/password.html.twig',[
          'formChangePassword'=>$formChangePassword->createView(),
            'notification'=>$notification
        ]);
    }
}
