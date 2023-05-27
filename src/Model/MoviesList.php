<?php

declare(strict_types=1);

namespace App\Model;

class MoviesList
{
    /**
     * @var MovieDetails[]
     */
    private array $movies;

    /**
     * @param MovieDetails[] $movies
     */
    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }

    public function setMovies(array $movies): self
    {
        $this->movies = $movies;

        return $this;
    }
}
