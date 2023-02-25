<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardUserController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
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

    #[Route('/dashboard/user/delete/{id}', name: 'app_dashboard_user_delete', methods: ['POST'])]
    public function deleteUser(User $user): Response
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this->addFlash('success', 'Utilisateur supprimé avec succès');

        return $this->redirectToRoute('app_dashboard_user');
    }


}


