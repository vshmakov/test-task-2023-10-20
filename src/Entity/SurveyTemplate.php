<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\IdAutogeneratedIntTrait;
use App\Repository\SurveyTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyTemplateRepository::class)]
class SurveyTemplate
{
    use IdAutogeneratedIntTrait;

    /** @var Collection<int, QuestionTemplate> */
    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: QuestionTemplate::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $questions;

    /** @var Collection<int, Survey> */
    #[ORM\OneToMany(mappedBy: 'template', targetEntity: Survey::class, orphanRemoval: true)]
    private Collection $surveys;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->surveys = new ArrayCollection();
    }

    /**
     * @return Collection<int, QuestionTemplate>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(QuestionTemplate $question): void
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setSurvey($this);
        }
    }

    public function removeQuestion(QuestionTemplate $question): void
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }
    }

    /**
     * @return Collection<int, Survey>
     */
    public function getSurveys(): Collection
    {
        return $this->surveys;
    }

    public function addSurvey(Survey $survey): void
    {
        if (!$this->surveys->contains($survey)) {
            $this->surveys->add($survey);
            $survey->setTemplate($this);
        }
    }

    public function removeSurvey(Survey $survey): void
    {
        if ($this->surveys->removeElement($survey)) {
            // set the owning side to null (unless already changed)
            if ($survey->getTemplate() === $this) {
                $survey->setTemplate(null);
            }
        }
    }
}
