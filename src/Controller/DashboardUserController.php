<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardUserController extends AbstractController
{
    #[Route('/dashboard/user', name: 'app_dashboard_user')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboardUser.html.twig');
    }


    #[Route('/dashboard/user', name: 'app_dashboard_user')]
    public function allUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();
        return $this->render('dashboard/dashboardUser.html.twig', [
            'users' => $users
        ]);
    }
}


