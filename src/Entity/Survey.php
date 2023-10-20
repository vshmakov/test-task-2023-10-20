<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @var Collection<int, Question> */
    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: Question::class, orphanRemoval: true)]
    private Collection $questions;

    #[ORM\ManyToOne(inversedBy: 'surveys')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SurveyTemplate $template = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): void
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setSurvey($this);
        }
    }

    public function removeQuestion(Question $question): void
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }
    }

    public function getTemplate(): ?SurveyTemplate
    {
        return $this->template;
    }

    public function setTemplate(?SurveyTemplate $template): void
    {
        $this->template = $template;
    }
}
