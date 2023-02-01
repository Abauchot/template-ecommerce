<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCategoryController extends AbstractController
{
    #[Route('/dashboard/category', name: 'app_dashboard_category')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboardCategory.html.twig');
    }

    #[Route('/dashboard/category', name: 'app_dashboard_category')]
    public function allUsers(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();
        return $this->render('dashboard/dashboardCategory.html.twig', [
            'categories' => $categories
        ]);
    }
}
