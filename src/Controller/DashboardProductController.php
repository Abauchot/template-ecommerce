<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardProductController extends AbstractController
{
    #[Route('/dashboard/product', name: 'app_dashboard_product')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboardProduct.html.twig');
    }

    #[Route('/dashboard/product', name: 'app_dashboard_product')]
    public function AllProducts(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        return $this->render('dashboard/dashboardProduct.html.twig',[
            'products' => $products
        ]);
    }
}
