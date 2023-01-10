<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Trait\TimestampableEntityGroups;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\CompetitorProductPriceHistoricalRepository;

use App\Controller\CreateCompetitorProduct;


#[ORM\Entity(repositoryClass: CompetitorProductPriceHistoricalRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
#[ORM\Index(columns: ['created_at'])]
#[ORM\Index(columns: ['updated_at'])]




class CompetitorProductPriceHistorical
{
    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/[^0-9.]/",
        match: false,
        message: "Champ numérique uniquement"
    )]
    #[Groups(['product:read'])]
    private ?float $price = null;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    private $deletedAt;


    #[ORM\ManyToOne(inversedBy: 'competitorProductPriceHistoricals', cascade: [ 'persist' ])]
    #[Groups(['product:read'])]

    private ?CompetitorProduct $product_competitor = null;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    #[Groups(['product:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['product:read'])]
    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
    #[Groups(['product:read'])]
    public function getProductCompetitor(): ?CompetitorProduct
    {
        return $this->product_competitor;
    }

    public function setProductCompetitor(?CompetitorProduct $product_competitor): self
    {
        $this->product_competitor = $product_competitor;

        return $this;
    }
}
