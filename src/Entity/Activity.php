<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: CiteEducativeFeedback::class, mappedBy: 'participatedActivity')]
    private Collection $citeEducativeFeedback;

    public function __construct()
    {
        $this->citeEducativeFeedback = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $citeEducativeFeedback->addParticipatedActivity($this);
        }

        return $this;
    }

    public function removeCiteEducativeFeedback(CiteEducativeFeedback $citeEducativeFeedback): self
    {
        if ($this->citeEducativeFeedback->removeElement($citeEducativeFeedback)) {
            $citeEducativeFeedback->removeParticipatedActivity($this);
        }

        return $this;
    }
}
