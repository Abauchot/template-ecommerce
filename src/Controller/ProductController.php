<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private $entityManager;

    public function __constructor(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/produits', name: 'app_products')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig',[
            'products'=> $products
        ]);
    }

    #[Route('/produit/{slug}', name: 'app_product')]
    public function showProduct(ManagerRegistry $doctrine, $slug): Response
    {
        $product = $doctrine->getRepository(Product::class)->findOneBy(['slug'=>$slug]);
        if(!$product){
            return $this->redirectToRoute('app_products');
        }
        return $this->render('product/showProduct.html.twig',[
            'product'=> $product
        ]);
    }
}
