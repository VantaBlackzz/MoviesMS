<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $title;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $description;

    /**
     * @var Collection<Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class)]
    #[ORM\JoinTable(name: 'movie_to_genres')]
    private Collection $genres;

    #[ORM\Column(length: 255, nullable: false)]
    private string $tagline;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $year;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $rating;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $duration;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<Genres>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    /**
     * @param Collection<Genres> $genres
     * @return $this
     */
    public function setGenres(Collection $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): self
    {
        $this->tagline = $tagline;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
