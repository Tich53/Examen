<?php

// CompetitorProduct.php

namespace App\Entity;


use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
// use App\State\CompetitorProductStateProcessor;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Trait\TimestampableEntityGroups;
use Doctrine\Common\Collections\Collection;
use App\Repository\CompetitorProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\CreateCompetitorProduct;

#[ORM\Entity(repositoryClass: CompetitorProductRepository::class)]
#[ORM\UniqueConstraint(
    name: 'competitor_product_unique_idx',
    columns: ['product_id', 'competitor_id']
)]
#[ORM\Index(columns: ['cleaned_name'])]
#[ORM\Index(columns: ['cleaned_reference'])]
#[ORM\Index(columns: ['cleaned_brand'])]
#[ORM\Index(columns: ['is_in_stock'])]
#[ApiResource(
    security: "is_granted('ROLE_USER')",
    normalizationContext: ['groups' => ['competitor_product:read', 'timestampable']],
    denormalizationContext: ['groups' => ['competitor_product:write']],
    operations: [
        new Get(security: "is_granted('ROLE_ADMIN') or is_granted('COMPETITOR_PRODUCT_VIEW', object)"),
        new Post(name: 'publication', controller: CreateCompetitorProduct::class, denormalizationContext: ['groups' => ['competitor_product:write']],),
        new Put(),
        new GetCollection(security: "is_granted('ROLE_USER')"),
    ]

)]

#[ApiFilter(SearchFilter::class, properties: [
    'raw_name' => 'ipartial',
    'cleaned_reference' => 'ipartial',
    'raw_reference' => 'ipartial',
    'cleaned_brand' => 'ipartial',
    'raw_brand' => 'ipartial',
    'product' => 'ipartial',
    'competitor' => 'exact'
])]
#[ApiFilter(BooleanFilter::class, properties: ['is_in_stock'])]
#[ApiFilter(RangeFilter::class, properties: ['price'])]
#[ApiFilter(DateFilter::class, properties: ['createdAt', 'updatedAt', 'deletedAt' => DateFilter::EXCLUDE_NULL])]

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false)]
#[HasLifecycleCallbacks]
class CompetitorProduct
{
    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['competitor_product:read', 'competitor_product:write', 'product:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/[^0-9.]/",
        match: false,
        message: "Champ numérique uniquement"
    )]
    #[Groups(['competitor_product:read', 'competitor_product:write', 'product:read'])]
    private ?float $price = 0;

    #[ORM\Column(length: 255)]

    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'competitorProducts')]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'competitorProducts')]
    #[Groups(['competitor_product:read', 'competitor_product:write', 'product:read'])]
    private ?Competitor $competitor = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    private ?string $raw_name = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    private ?string $cleaned_name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?string $raw_reference = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    private ?string $cleaned_reference = null;

    #[ORM\Column(length: 45)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?string $raw_brand = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    private ?string $cleaned_brand = null;

    #[ORM\Column]
    #[Groups(['competitor_product:read', 'competitor_product:write'])]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    private ?bool $is_in_stock = true;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    private $deletedAt;

    #[ORM\OneToMany(mappedBy: 'product_competitor', targetEntity: CompetitorProductPriceHistorical::class)]
    #[Groups(['product:read'])]
    private Collection $competitorProductPriceHistoricals;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['cleaned_brand', 'cleaned_reference'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->competitorProductPriceHistoricals = new ArrayCollection();
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
    #[Groups(['competitor_product:write'])]
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getUrl(): ?string
    {
        return $this->url;
    }
    #[Groups(['competitor_product:write'])]
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
    public function getProduct(): ?Product
    {
        return $this->product;
    }
    #[Groups(['competitor_product:write'])]
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
    #[Groups(['competitor_product:read', 'product:read'])]
    public function getCompetitor(): ?Competitor
    {
        return $this->competitor;
    }
    #[Groups(['competitor_product:write'])]
    public function setCompetitor(?Competitor $competitor): self
    {
        $this->competitor = $competitor;

        return $this;
    }
    public function getRawName(): ?string
    {
        return $this->raw_name;
    }
    #[Groups(['competitor_product:write'])]
    public function setRawName(string $raw_name): self
    {
        $this->raw_name = $raw_name;

        return $this;
    }
    public function getCleanedName(): ?string
    {
        return $this->cleaned_name;
    }
    #[Groups(['competitor_product:write'])]
    public function setCleanedName(?string $cleaned_name): self
    {
        $this->cleaned_name = $cleaned_name;

        return $this;
    }
    public function getRawReference(): ?string
    {
        return $this->raw_reference;
    }
    #[Groups(['competitor_product:write'])]
    public function setRawReference(string $raw_reference): self
    {
        $this->raw_reference = $raw_reference;

        return $this;
    }
    public function getCleanedReference(): ?string
    {
        return $this->cleaned_reference;
    }
    #[Groups(['competitor_product:write'])]
    public function setCleanedReference(string $cleaned_reference): self
    {
        $this->cleaned_reference = $cleaned_reference;

        return $this;
    }
    public function getRawBrand(): ?string
    {
        return $this->raw_brand;
    }
    #[Groups(['competitor_product:write'])]
    public function setRawBrand(string $raw_brand): self
    {
        $this->raw_brand = $raw_brand;

        return $this;
    }
    public function getCleanedBrand(): ?string
    {
        return $this->cleaned_brand;
    }
    #[Groups(['competitor_product:write'])]
    public function setCleanedBrand(string $cleaned_brand): self
    {
        $this->cleaned_brand = $cleaned_brand;

        return $this;
    }
    public function isIsInStock(): ?bool
    {
        return $this->is_in_stock;
    }
    #[Groups(['competitor_product:write'])]
    public function setIsInStock(bool $is_in_stock): self
    {
        $this->is_in_stock = $is_in_stock;

        return $this;
    }
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    #[Groups(['competitor_product:write'])]
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }


    /**
     * @return Collection<int, CompetitorProductPriceHistorical>
     */
    public function getCompetitorProductPriceHistoricals(): Collection
    {
        return $this->competitorProductPriceHistoricals;
    }

    public function addCompetitorProductPriceHistorical(CompetitorProductPriceHistorical $competitorProductPriceHistorical): self
    {
        if (!$this->competitorProductPriceHistoricals->contains($competitorProductPriceHistorical)) {
            $this->competitorProductPriceHistoricals->add($competitorProductPriceHistorical);
            $competitorProductPriceHistorical->setProductCompetitor($this);
        }

        return $this;
    }

    public function removeCompetitorProductPriceHistorical(CompetitorProductPriceHistorical $competitorProductPriceHistorical): self
    {
        if ($this->competitorProductPriceHistoricals->removeElement($competitorProductPriceHistorical)) {
            // set the owning side to null (unless already changed)
            if ($competitorProductPriceHistorical->getProductCompetitor() === $this) {
                $competitorProductPriceHistorical->setProductCompetitor(null);
            }
        }

        return $this;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
