<?php

namespace App\Entity;

use App\Repository\CiteEducativeFeedbackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CiteEducativeFeedbackRepository::class)]
class CiteEducativeFeedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'citeEducativeFeedback')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AgeGroup $ageGroup = null;

    #[ORM\ManyToOne(inversedBy: 'citeEducativeFeedback')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Neighborhood $neighborhood = null;

    #[ORM\Column]
    private ?bool $knowCiteEducative = null;

    #[ORM\Column(length: 255)]
    private ?string $knowFrom = null;

    #[ORM\ManyToMany(targetEntity: Activity::class, inversedBy: 'citeEducativeFeedback')]
    private Collection $participatedActivity;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $memorableActivity = null;

    #[ORM\Column]
    private ?bool $interestedInActivities = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $whyInterestedIn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?String $developmentDomain = null;

    #[ORM\Column(length: 255)]
    private ?string $specificActivity = null;

    public function __construct()
    {
        $this->participatedActivity = new ArrayCollection();
        $this->developmentDomain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgeGroup(): ?AgeGroup
    {
        return $this->ageGroup;
    }

    public function setAgeGroup(?AgeGroup $ageGroup): self
    {
        $this->ageGroup = $ageGroup;

        return $this;
    }

    public function getNeighborhood(): ?Neighborhood
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(?Neighborhood $neighborhood): self
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    public function isKnowCiteEducative(): ?bool
    {
        return $this->knowCiteEducative;
    }

    public function setKnowCiteEducative(bool $knowCiteEducative): self
    {
        $this->knowCiteEducative = $knowCiteEducative;

        return $this;
    }

    public function getKnowFrom(): ?string
    {
        return $this->knowFrom;
    }

    public function setKnowFrom(string $knowFrom): self
    {
        $this->knowFrom = $knowFrom;

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getParticipatedActivity(): Collection
    {
        return $this->participatedActivity;
    }

    public function addParticipatedActivity(Activity $participatedActivity): self
    {
        if (!$this->participatedActivity->contains($participatedActivity)) {
            $this->participatedActivity->add($participatedActivity);
        }

        return $this;
    }

    public function removeParticipatedActivity(Activity $participatedActivity): self
    {
        $this->participatedActivity->removeElement($participatedActivity);

        return $this;
    }

    public function getMemorableActivity(): ?string
    {
        return $this->memorableActivity;
    }

    public function setMemorableActivity(?string $memorableActivity): self
    {
        $this->memorableActivity = $memorableActivity;

        return $this;
    }

    public function isInterestedInActivities(): ?bool
    {
        return $this->interestedInActivities;
    }

    public function setInterestedInActivities(bool $interestedInActivities): self
    {
        $this->interestedInActivities = $interestedInActivities;

        return $this;
    }

    public function getWhyInterestedIn(): ?string
    {
        return $this->whyInterestedIn;
    }

    public function setWhyInterestedIn(?string $whyInterestedIn): self
    {
        $this->whyInterestedIn = $whyInterestedIn;

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getDevelopmentDomain(): Collection
    {
        return $this->developmentDomain;
    }

    public function addDevelopmentDomain(Activity $developmentDomain): self
    {
        if (!$this->developmentDomain->contains($developmentDomain)) {
            $this->developmentDomain->add($developmentDomain);
        }

        return $this;
    }

    public function removeDevelopmentDomain(Activity $developmentDomain): self
    {
        $this->developmentDomain->removeElement($developmentDomain);

        return $this;
    }

    public function getSpecificActivity(): ?string
    {
        return $this->specificActivity;
    }

    public function setSpecificActivity(string $specificActivity): self
    {
        $this->specificActivity = $specificActivity;

        return $this;
    }
}
