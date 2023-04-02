<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Survey::class, inversedBy: 'questions')]
    private Collection $survey;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuestionsChoice::class, orphanRemoval: true)]
    private Collection $questionsChoices;

    public function __construct()
    {
        $this->survey = new ArrayCollection();
        $this->questionsChoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Survey>
     */
    public function getSurvey(): Collection
    {
        return $this->survey;
    }

    public function addSurvey(Survey $survey): self
    {
        if (!$this->survey->contains($survey)) {
            $this->survey->add($survey);
        }

        return $this;
    }

    public function removeSurvey(Survey $survey): self
    {
        $this->survey->removeElement($survey);

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, QuestionsChoice>
     */
    public function getQuestionsChoices(): Collection
    {
        return $this->questionsChoices;
    }

    public function addQuestionsChoice(QuestionsChoice $questionsChoice): self
    {
        if (!$this->questionsChoices->contains($questionsChoice)) {
            $this->questionsChoices->add($questionsChoice);
            $questionsChoice->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestionsChoice(QuestionsChoice $questionsChoice): self
    {
        if ($this->questionsChoices->removeElement($questionsChoice)) {
            // set the owning side to null (unless already changed)
            if ($questionsChoice->getQuestion() === $this) {
                $questionsChoice->setQuestion(null);
            }
        }

        return $this;
    }
}
