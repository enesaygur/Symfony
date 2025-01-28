<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
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

    
    #[Route('/product/new', name:'product_new')]
    public function new(Request $request, EntityManagerInterface $manager):Response{
        $product= new Product;
        $form =$this->createForm(ProductType::class,$product);
        $form-> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($product);
            $manager->flush();
            $this->addFlash('notice','Product created successfully!');
            // dd($request->request->all());
            // dd($product);
            return $this->redirectToRoute('product_show',['id'=>$product->getId(),]);
        }
        return $this->render('product/new.html.twig',[
            'form'=> $form,
        ]);
    }
    #[Route('/product/{id<\d+>}/edit', name:'product_edit')]
    public function edit(Product $product, Request $request, EntityManagerInterface $manager): Response{
        $form =$this->createForm(ProductType::class,$product);
        $form-> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->flush();
            $this->addFlash('notice','Product updated successfully!');
            // dd($request->request->all());
            // dd($product);
            return $this->redirectToRoute('product_show',['id'=>$product->getId(),]);
        }
        return $this->render('product/edit.html.twig',[
            'form'=> $form,
        ]);
    }
}
