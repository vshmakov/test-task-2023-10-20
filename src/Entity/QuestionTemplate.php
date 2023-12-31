<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\IdAutogeneratedIntTrait;
use App\Entity\Traits\TitleNotNullableTrait;
use App\Repository\QuestionTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionTemplateRepository::class)]
class QuestionTemplate
{
    use IdAutogeneratedIntTrait;
    use TitleNotNullableTrait;

    /** @var Collection<int, QuestionOptionTemplate> */
    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuestionOptionTemplate::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $options;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SurveyTemplate $survey = null;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return Collection<int, QuestionOptionTemplate>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(QuestionOptionTemplate $option): void
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
            $option->setQuestion($this);
        }
    }

    public function removeOption(QuestionOptionTemplate $option): void
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getQuestion() === $this) {
                $option->setQuestion(null);
            }
        }
    }

    public function getSurvey(): ?SurveyTemplate
    {
        return $this->survey;
    }

    public function setSurvey(?SurveyTemplate $survey): void
    {
        $this->survey = $survey;
    }
}
