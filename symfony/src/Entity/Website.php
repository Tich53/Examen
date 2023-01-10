<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\WebsiteRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Trait\TimestampableEntityGroups;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
#[UniqueEntity(
    fields: ['url'],
    message: "Le site est déjà présent.",
)]

#[ApiResource(
    security: "is_granted('ROLE_USER')",
    normalizationContext: ['groups' => ['website:read']],
    operations: [
        new Get(),
        new GetCollection(security: "is_granted('ROLE_USER')"),
    ]
)]

class Website
{

    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read', 'product:read', 'website:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9:\/\.\-]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    #[Groups(['website:read', 'user:read'])]
    private ?string $url = null;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    private $deletedAt;

    #[ORM\OneToMany(mappedBy: 'website', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'website', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\ManyToMany(targetEntity: Competitor::class, inversedBy: 'websites')]
    #[Groups(['user:read', 'website:read'])]
    private Collection $competitor;

    #[ORM\OneToMany(mappedBy: 'website', targetEntity: ScrapingHistorical::class)]
    private Collection $scrapingHistoricals;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->competitor = new ArrayCollection();
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
        $this->scrapingHistoricals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setWebsite($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getWebsite() === $this) {
                $user->setWebsite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setWebsite($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getWebsite() === $this) {
                $product->setWebsite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competitor>
     */
    #[Groups(['user:read', 'website:read'])]
    public function getCompetitor(): Collection
    {
        return $this->competitor;
    }

    public function addCompetitor(Competitor $competitor): self
    {
        if (!$this->competitor->contains($competitor)) {
            $this->competitor->add($competitor);
        }

        return $this;
    }

    public function removeCompetitor(Competitor $competitor): self
    {
        $this->competitor->removeElement($competitor);

        return $this;
    }

    public function __toString(): string
    {
        return $this->url;
    }

    /**
     * @return Collection<int, ScrapingHistorical>
     */
    public function getScrapingHistoricals(): Collection
    {
        return $this->scrapingHistoricals;
    }

    public function addScrapingHistorical(ScrapingHistorical $scrapingHistorical): self
    {
        if (!$this->scrapingHistoricals->contains($scrapingHistorical)) {
            $this->scrapingHistoricals->add($scrapingHistorical);
            $scrapingHistorical->setWebsite($this);
        }

        return $this;
    }

    public function removeScrapingHistorical(ScrapingHistorical $scrapingHistorical): self
    {
        if ($this->scrapingHistoricals->removeElement($scrapingHistorical)) {
            // set the owning side to null (unless already changed)
            if ($scrapingHistorical->getWebsite() === $this) {
                $scrapingHistorical->setWebsite(null);
            }
        }

        return $this;
    }
}
