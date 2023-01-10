<?php

namespace App\Controller;

use ApiPlatform\State\ProcessorInterface;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductApiController extends AbstractController
{
    #[Route('/product/api', name: 'app_product_api', methods: ["GET"])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->json($productRepository->findAll(), 200, [], ['groups' => 'product:read']);
    }
}
