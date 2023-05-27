<?php

declare(strict_types=1);

namespace App\Model;

class GenresList
{
    /**
     * @var Genre[]
     */
    private array $genre;

    /**
     * @param Genre[] $genre
     */
    public function __construct(array $genre)
    {
        $this->genre = $genre;
    }

    public function getGenre(): array
    {
        return $this->genre;
    }

    public function setGenre(array $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
