<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

trait TitleNotNullableTrait
{
    #[ORM\Column]
    private ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function requireTitle(): string
    {
        Assert::notNull($this->title);

        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
