<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Movie;
use App\Model\MovieDetails;

class MovieMapper
{
    public static function map(Movie $movie, MovieDetails $details): void
    {
        $details
            ->setTitle($movie->getTitle())
            ->setDescription($movie->getDescription())
            ->setGenre($movie->getGenre())
            ->setDuration($movie->getDuration())
            ->setRating($movie->getRating())
            ->setYear($movie->getYear())
            ->setTagline($movie->getTagline());
    }
}
