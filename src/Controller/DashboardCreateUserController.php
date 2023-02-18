<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\DashboardUserCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCreateUserController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/create/user', name: 'app_dashboard_create_user')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $formAdminCreateUser = $this->createForm(DashboardUserCreateType::class,$user);

        $formAdminCreateUser ->handleRequest($request);
        if($formAdminCreateUser->isSubmitted() && $formAdminCreateUser->isValid()){
            $user = $formAdminCreateUser ->getData();
            $password = $hasher->hashPassword($user,$user->getPassword());
            $user -> setPassword($password);

            dd($user);

            $this->entityManager->persist($user);
            $this->entityManager->flush();



        }

        return $this->render('dashboard/dashboardCreateUser.html.twig',[
        'formAdminCreateUser' => $formAdminCreateUser->createView()
            ]);
    }
}
