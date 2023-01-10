<?php
// src/service/CompetitorProductPostingHandler.php
namespace App\Service;

use App\Entity\CompetitorProduct;
use App\Repository\CompetitorRepository;
use App\Repository\ProductRepository;
use App\Repository\CompetitorProductRepository;
use App\Entity\CompetitorProductPriceHistorical;
use Doctrine\ORM\EntityManagerInterface;

class CompetitorProductPostingHandler
{
    private $competitorProductRepository;

    public function __construct(CompetitorProductRepository $competitorProductRepository, EntityManagerInterface $entityManager, CompetitorRepository $competitorRepository, ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->competitorProductRepository = $competitorProductRepository;
        $this->competitorRepository = $competitorRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(CompetitorProduct $data)
    {
        $competitorProduct=$this->competitorProductRepository->findOneByUrl($data->getUrl());

        if($competitorProduct)
        {
            $competitorProduct->setPrice($data->getPrice());

            $competitorProductPriceHistorical = (new CompetitorProductPriceHistorical())
                ->setPrice($data->getPrice())
                ->setProductCompetitor($competitorProduct);
            $this->entityManager->persist($competitorProductPriceHistorical);
            $this->entityManager->flush();

            return $competitorProduct;
        }else{

            $competitorProductPriceHistorical = (new CompetitorProductPriceHistorical())
            ->setPrice($data->getPrice())
            ->setProductCompetitor($data);
            $this->entityManager->persist($competitorProductPriceHistorical);
            $this->entityManager->flush();

            return $data;
        }
    }
}









