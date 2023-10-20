<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestionOptionTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionOptionTemplateRepository::class)]
class QuestionOptionTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private bool $isRight = false;

    #[ORM\ManyToOne(inversedBy: 'options')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionTemplate $question = null;

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

    public function isRight(): bool
    {
        return $this->isRight;
    }

    public function setRight(bool $isRight): void
    {
        $this->isRight = $isRight;
    }

    public function getQuestion(): ?QuestionTemplate
    {
        return $this->question;
    }

    public function setQuestion(?QuestionTemplate $question): void
    {
        $this->question = $question;
    }
}