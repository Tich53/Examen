<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(EntityManagerInterface $em): Response
    {
        $matchesId = $em->getRepository(Product::class)->findMatchesId();
        dd($matchesId);
        return $this->render('product/index.html.twig', [
            'matchesId' =>   $matchesId
        ]);
    }
}
