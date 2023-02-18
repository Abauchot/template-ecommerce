<?php

namespace App\Controller;


use App\Entity\Category;
use App\Form\DashboardCategoryCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCreateCategoryController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/create/category', name: 'app_dashboard_create_category')]
    public function index(Request $request): Response
    {
        $category = new Category();
        $formAdminCreateCategory = $this->createForm(DashboardCategoryCreateType::class,$category);

        $formAdminCreateCategory -> handleRequest($request);
        if($formAdminCreateCategory->isSubmitted() && $formAdminCreateCategory->isValid()){
            $category = $formAdminCreateCategory ->getData();
            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }

        return $this->render('dashboard/dashboardCreateCategory.html.twig', [
            'formAdminCreateCategory' => $formAdminCreateCategory->createView()
        ]);
    }
}
