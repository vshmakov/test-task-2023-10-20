<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestionOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionOptionRepository::class)]
class QuestionOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private bool $isRight = false;

    #[ORM\Column]
    private bool $isChosen = false;

    #[ORM\ManyToOne(inversedBy: 'options')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

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

    public function isChosen(): bool
    {
        return $this->isChosen;
    }

    public function setChosen(bool $isChosen): void
    {
        $this->isChosen = $isChosen;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): void
    {
        $this->question = $question;
    }
}
