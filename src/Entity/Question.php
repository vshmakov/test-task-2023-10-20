<?php

declare(strict_types=1);

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

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private bool $isAnswered = false;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuestionOption::class, orphanRemoval: true)]
    private Collection $options;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Survey $survey = null;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isAnswered(): bool
    {
        return $this->isAnswered;
    }

    public function setAnswered(bool $isAnswered): void
    {
        $this->isAnswered = $isAnswered;
    }

    /**
     * @return Collection<int, QuestionOption>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(QuestionOption $option): void
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
            $option->setQuestion($this);
        }
    }

    public function removeOption(QuestionOption $option): void
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getQuestion() === $this) {
                $option->setQuestion(null);
            }
        }
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(?Survey $survey): void
    {
        $this->survey = $survey;
    }
}
