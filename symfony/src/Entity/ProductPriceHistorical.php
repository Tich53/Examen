<?php

namespace App\Entity;

use App\Entity\Trait\TimestampableEntityGroups;
use App\Repository\ProductPriceHistoricalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProductPriceHistoricalRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false)]
#[ORM\Index(columns:['created_at'])]
#[ORM\Index(columns:['updated_at'])]

class ProductPriceHistorical
{

    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?float $price = null;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    private $deletedAt;

    #[ORM\ManyToOne(inversedBy: 'productPriceHistoricals')]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?Product $product = null;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
