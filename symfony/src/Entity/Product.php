<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use App\Entity\Trait\TimestampableEntityGroups;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Index(columns: ['cleaned_brand'])]
#[ORM\Index(columns: ['cleaned_reference'])]
#[ORM\Index(columns: ['name'])]
#[ORM\Index(columns: ['created_at'])]
#[ORM\Index(columns: ['updated_at'])]

#[ApiResource(
    security: "is_granted('ROLE_USER')",
    normalizationContext: ['groups' => ['product:read', 'timestampable']],
    denormalizationContext: ['groups' => ['product:write']],
    operations: [
        new Get(security: "is_granted('ROLE_ADMIN') or is_granted('PRODUCT_VIEW', object)"),
        new GetCollection(),
    ]
)]

#[ApiFilter(SearchFilter::class, properties: [
    'cleaned_reference' => 'ipartial',
    'raw_reference' => 'ipartial',
    'cleaned_brand' => 'ipartial',
    'raw_brand' => 'ipartial',
    'name' => 'ipartial',
    'category' => 'ipartial',
    'tags' => 'ipartial'
])]
#[ApiFilter(RangeFilter::class, properties: ['price'])]
#[ApiFilter(DateFilter::class, properties: ['createdAt', 'updatedAt', 'deletedAt' => DateFilter::EXCLUDE_NULL])]

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false)]
#[HasLifecycleCallbacks]
class Product
{
    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $image = null;

    #[ORM\Column(length: 45)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Groups(['product:read', 'product:write'])]
    private ?string $raw_reference = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    private ?string $cleaned_reference = null;

    #[ORM\Column(length: 45)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Groups(['product:read'])]
    private ?string $raw_brand = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    private ?string $cleaned_brand = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private float $price = 1;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Groups(['product:read', 'product:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Groups(['product:read', 'product:write'])]
    private ?string $url = null;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['product:read', 'product:write', 'timestampable'])]
    private $deletedAt;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'product')]
    #[Groups(['product:read'])]
    private Collection $tags;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups(['product:read'])]
    private ?Website $website = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductPriceHistorical::class)]
    private Collection $productPriceHistoricals;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: CompetitorProduct::class)]
    #[Groups(['product:read'])]
    private Collection $competitorProducts;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['name', 'cleaned_brand', 'cleaned_reference'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->productPriceHistoricals = new ArrayCollection();
        $this->competitorProducts = new ArrayCollection();
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


    public function getRawReference(): ?string
    {
        return $this->raw_reference;
    }

    #[Groups(['product:write'])]
    public function setRawReference(string $raw_reference): self
    {
        $this->raw_reference = $raw_reference;

        return $this;
    }

    public function getCleanedReference(): ?string
    {
        return $this->cleaned_reference;
    }
    #[Groups(['product:write'])]
    public function setCleanedReference(string $cleaned_reference): self
    {
        $this->cleaned_reference = $cleaned_reference;

        return $this;
    }

    public function getRawBrand(): ?string
    {
        return $this->raw_brand;
    }
    #[Groups(['product:write'])]
    public function setRawBrand(string $raw_brand): self
    {
        $this->raw_brand = $raw_brand;

        return $this;
    }

    public function getCleanedBrand(): ?string
    {
        return $this->cleaned_brand;
    }
    #[Groups(['product:write'])]
    public function setCleanedBrand(string $cleaned_brand): self
    {
        $this->cleaned_brand = $cleaned_brand;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    #[Groups(['timestampable'])]
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addProduct($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProduct($this);
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    #[Groups(['product:read'])]
    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    public function setWebsite(?Website $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, ProductPriceHistorical>
     */
    public function getProductPriceHistoricals(): Collection
    {
        return $this->productPriceHistoricals;
    }

    public function addProductPriceHistorical(ProductPriceHistorical $productPriceHistorical): self
    {
        if (!$this->productPriceHistoricals->contains($productPriceHistorical)) {
            $this->productPriceHistoricals->add($productPriceHistorical);
            $productPriceHistorical->setProduct($this);
        }

        return $this;
    }

    public function removeProductPriceHistorical(ProductPriceHistorical $productPriceHistorical): self
    {
        if ($this->productPriceHistoricals->removeElement($productPriceHistorical)) {
            // set the owning side to null (unless already changed)
            if ($productPriceHistorical->getProduct() === $this) {
                $productPriceHistorical->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetitorProduct>
     */
    #[Groups(['product:read'])]
    public function getCompetitorProducts(): Collection
    {
        return $this->competitorProducts;
    }

    public function addCompetitorProduct(CompetitorProduct $competitorProduct): self
    {
        if (!$this->competitorProducts->contains($competitorProduct)) {
            $this->competitorProducts->add($competitorProduct);
            $competitorProduct->setProduct($this);
        }

        return $this;
    }

    public function removeCompetitorProduct(CompetitorProduct $competitorProduct): self
    {
        if ($this->competitorProducts->removeElement($competitorProduct)) {
            // set the owning side to null (unless already changed)
            if ($competitorProduct->getProduct() === $this) {
                $competitorProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
