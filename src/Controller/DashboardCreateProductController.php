<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\DashboardProductCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardCreateProductController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/create/product', name: 'app_dashboard_create_product')]
    public function index(Request $request): Response
    {
        $product = new Product();
        $formAdminCreateProduct = $this->createForm(DashboardProductCreateType::class,$product);

        $formAdminCreateProduct -> handleRequest($request);
        if ($formAdminCreateProduct->isSubmitted() && $formAdminCreateProduct->isValid()){
            $product = $formAdminCreateProduct -> getData();
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }
        return $this->render('dashboard/dashboardCreateProduct.html.twig',[
            'formAdminCreateProduct' => $formAdminCreateProduct->createView()
        ]);
    }
}
