<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
final class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index')]
    public function index(ProductRepository $repository): Response
    {      
        // $products =$repository ->findAll(); 1. yol
        // dd($products); çıktıyı görmek için
        // return $this->render('product/index.html.twig', [ 1. yol
        //     'controller_name' => 'ProductController',
        // ]);
        return $this->render('product/index.html.twig', [
            'products' => $repository ->findAll(),
        ]);
    }
}
