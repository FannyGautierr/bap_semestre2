<?php

namespace App\Entity;

use App\Repository\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: Submitter::class)]
    private Collection $submitters;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->submitters = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setSurvey($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }

        return $this;
    }

    public function getQuestionByType(string $type): Collection
    {
        $questions = new ArrayCollection();
        foreach ($this->questions as $question) {
            if($question->getType() === $type) {
                $questions->add($question);
            }
        }
        return $questions;
    }

    public function getQuestionByTypeAndAge(string $type, int $age): Collection
    {
        $questions = new ArrayCollection();
        foreach ($this->questions as $question) {
            if($question->getType() === $type && $question->getAge() === $age) {
                $questions->add($question);
            }
        }
        return $questions;
    }

    /**
     * @return Collection<int, Submitter>
     */
    public function getSubmitters(): Collection
    {
        return $this->submitters;
    }

    public function addSubmitter(Submitter $submitter): self
    {
        if (!$this->submitters->contains($submitter)) {
            $this->submitters->add($submitter);
            $submitter->setSurvey($this);
        }

        return $this;
    }

    public function removeSubmitter(Submitter $submitter): self
    {
        if ($this->submitters->removeElement($submitter)) {
            // set the owning side to null (unless already changed)
            if ($submitter->getSurvey() === $this) {
                $submitter->setSurvey(null);
            }
        }

        return $this;
    }

}
