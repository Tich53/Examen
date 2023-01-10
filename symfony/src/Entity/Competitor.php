<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CompetitorRepository;
use Doctrine\Common\Collections\Collection;
use App\Entity\Trait\TimestampableEntityGroups;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\IsTrueValidator;


#[ORM\Entity(repositoryClass: CompetitorRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false)]
#[ApiResource(
    security: "is_granted('ROLE_USER')",
    normalizationContext: ['groups' => ['competitor:read', 'timestampable']],
    denormalizationContext: ['groups' => ['competitor:write']],
    operations: [
        new Get(),
        new GetCollection(security: "is_granted('ROLE_USER')"),
    ]
)]

class Competitor
{
    use TimestampableEntityGroups;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['website:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 45, unique: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ':\/\.\_\-\s\"]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    #[Groups(['competitor:read', 'user:read', 'product:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Le champ ne doit pas être vide.")]
    #[Assert\Regex(
        pattern: "/[^a-zA-Z0-9:\/\.\-]/",
        match: false,
        message: "Certains caractères spéciaux ne sont pas autorisés"
    )]
    #[Groups(['competitor:read', 'user:read'])]
    private ?string $website = null;

    #[ORM\Column(name: "deletedAt", type: Types::DATE_MUTABLE, nullable: true)]
    private $deletedAt;

    #[ORM\ManyToMany(targetEntity: Website::class, mappedBy: 'competitor')]
    private Collection $websites;

    #[ORM\OneToMany(mappedBy: 'competitor', targetEntity: CompetitorProduct::class)]
    private Collection $competitorProducts;

    #[ORM\Column(length: 100)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->websites = new ArrayCollection();
        $this->competitorProducts = new ArrayCollection();
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
    #[Groups(['user:read'])]
    public function getId(): ?int
    {
        return $this->id;
    }
    #[Groups(['competitor_product:read'])]
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    #[Groups(['competitor_product:read'])]
    public function getWebsite(): ?string
    {
        return $this->website;
    }
    public function setWebsite(string $website): self
    {
        $this->website = $website;

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
     * @return Collection<int, Website>
     */

    public function getWebsites(): Collection
    {
        return $this->websites;
    }

    public function addWebsite(Website $website): self
    {
        if (!$this->websites->contains($website)) {
            $this->websites->add($website);
            $website->addCompetitor($this);
        }

        return $this;
    }

    public function removeWebsite(Website $website): self
    {
        if ($this->websites->removeElement($website)) {
            $website->removeCompetitor($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetitorProduct>
     */
    public function getCompetitorProducts(): Collection
    {
        return $this->competitorProducts;
    }

    public function addCompetitorProduct(CompetitorProduct $competitorProduct): self
    {
        if (!$this->competitorProducts->contains($competitorProduct)) {
            $this->competitorProducts->add($competitorProduct);
            $competitorProduct->setCompetitor($this);
        }

        return $this;
    }

    public function removeCompetitorProduct(CompetitorProduct $competitorProduct): self
    {
        if ($this->competitorProducts->removeElement($competitorProduct)) {
            // set the owning side to null (unless already changed)
            if ($competitorProduct->getCompetitor() === $this) {
                $competitorProduct->setCompetitor(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
