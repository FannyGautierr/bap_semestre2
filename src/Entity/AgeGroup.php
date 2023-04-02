<?php

namespace App\Entity;

use App\Repository\AgeGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgeGroupRepository::class)]
class AgeGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\OneToMany(mappedBy: 'ageGroup', targetEntity: CiteEducativeFeedback::class, orphanRemoval: true)]
    private Collection $citeEducativeFeedback;

    public function __construct()
    {
        $this->citeEducativeFeedback = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, CiteEducativeFeedback>
     */
    public function getCiteEducativeFeedback(): Collection
    {
        return $this->citeEducativeFeedback;
    }

    public function addCiteEducativeFeedback(CiteEducativeFeedback $citeEducativeFeedback): self
    {
        if (!$this->citeEducativeFeedback->contains($citeEducativeFeedback)) {
            $this->citeEducativeFeedback->add($citeEducativeFeedback);
            $citeEducativeFeedback->setAgeGroup($this);
        }

        return $this;
    }

    public function removeCiteEducativeFeedback(CiteEducativeFeedback $citeEducativeFeedback): self
    {
        if ($this->citeEducativeFeedback->removeElement($citeEducativeFeedback)) {
            // set the owning side to null (unless already changed)
            if ($citeEducativeFeedback->getAgeGroup() === $this) {
                $citeEducativeFeedback->setAgeGroup(null);
            }
        }

        return $this;
    }
}
