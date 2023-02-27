<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private $entityManager;

    public function __constructor(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/produits', name: 'app_products')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class,$search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $products = $doctrine->getRepository(Product::class)->findBySearch($search);
        }
        $products = $doctrine->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig',[
            'products'=> $products,
            'formSearchProduct' => $form->createView()
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
