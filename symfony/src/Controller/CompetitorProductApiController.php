<?php

namespace App\Controller;

use App\Entity\CompetitorProduct;
use App\Repository\CompetitorProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CompetitorProductApiController extends AbstractController
{

    #[Route('/competitor_products/api',  name: 'app_competitor_products_api_read', methods: ['GET'])]
    public function read(CompetitorProductRepository $competitorProductRepository, SerializerInterface $serializer)
    {

        return $this->json($competitorProductRepository->findAll(), 200, [], ['groups' => 'competitor_product:read']);
    }

    #[Route('/competitor_products/api',  name: 'app_competitor_products_api_write', methods: ['POST'])]
    public function write(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $jsonRecu = $request->getContent();

        /* try { */
            $competitorProduct = $serializer->deserialize($jsonRecu, CompetitorProduct::class . '[]', 'json');

/*             $em->persist($competitorProduct);
            $em->flush(); */

            dd($competitorProduct);

/*             return $this->json($competitorProduct, 201, [], ['groups' => "competitor_product:read"]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        } */
    }
}
