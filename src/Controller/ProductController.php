<?php

namespace App\Controller;

use App\Entity\Product;
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


    #[Route('/product/{id<\d+>}', name:'product_show')] // \d =[0-9] arası rakam, + ise  1 veya daha fazla basamaktan oluşmasıdır.
    public function show(Product $product): Response
    {
        
        return $this-> render('product/show.html.twig',[
            'product'=> $product
        ]);
    }
    // public function show($id, ProductRepository $repository): Response
    // {
    //     // dd($id);
    //     // $product= $repository ->findOneBy(['id'=> $id]);
    //     $product= $repository ->find($id);
    //     if ($product == null) {
    //         throw $this->createNotFoundException('Product not found');
    //     }
    //     return $this-> render('product/show.html.twig',[
    //         'product'=> $product
    //     ]);
    // }
}
