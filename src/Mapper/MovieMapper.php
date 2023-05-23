<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Genres;
use App\Entity\Movie;
use App\Model\MovieDetails;
use App\Model\Genres as GenresModel;

class MovieMapper
{
    public static function map(Movie $movie, MovieDetails $details): void
    {
        $details
            ->setTitle($movie->getTitle())
            ->setDescription($movie->getDescription())
            ->setDuration($movie->getDuration())
            ->setRating($movie->getRating())
            ->setYear($movie->getYear())
            ->setTagline($movie->getTagline());
    }

    public static function mapGenres(Movie $movie): array
    {
        return $movie->getGenres()
            ->map(fn (Genres $genres) => new GenresModel(
                $genres->getName()
            ))
            ->toArray();
    }
}
