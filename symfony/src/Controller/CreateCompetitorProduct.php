<?php

namespace App\Controller;

use App\Service\CompetitorProductPostingHandler;
use App\Entity\CompetitorProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;


#[AsController]
class CreateCompetitorProduct extends AbstractController
{
    private $competitorProductPostingHandler;

    public function __construct(CompetitorProductPostingHandler $competitorProductPostingHandler)
    {
        $this->competitorProductPostingHandler = $competitorProductPostingHandler;
    }

    public function __invoke(CompetitorProduct $data): CompetitorProduct
    {
        $result = $this->competitorProductPostingHandler->handle($data);
        return $result;
    }
}