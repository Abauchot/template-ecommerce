<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCategoryController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/category', name: 'app_dashboard_category')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboardCategory.html.twig');
    }

    #[Route('/dashboard/category', name: 'app_dashboard_category')]
    public function allCategories(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Category::class)->findAll();
        return $this->render('dashboard/dashboardCategory.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/dashboard/category/delete/{id}', name: 'app_dashboard_category_delete', methods: ['POST'])]
    public function deleteUser(Category $category): Response
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
        $this->addFlash('success', 'Catégorie supprimé avec succès');

        return $this->redirectToRoute('app_dashboard_category');
    }



}
