<?php 
namespace  App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {   
        // $contents= $this->renderView('home/index.html.twig'); 
        // return new Response($contents);

        return $this->render('home/index.html.twig');
    }

}