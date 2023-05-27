<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\Genre as GenreModel;
use App\RequestDTO\NewMovieRequest;
use App\Model\MovieDetails;
use App\Entity\Genres;
use App\Entity\Movie;

class MovieMapper
{
    public static function mapToModel(Movie $movie, MovieDetails $details): void
    {
        $details
            ->setTitle($movie->getTitle())
            ->setDescription($movie->getDescription())
            ->setDuration($movie->getDuration())
            ->setRating($movie->getRating())
            ->setYear($movie->getYear())
            ->setTagline($movie->getTagline());
    }

    public static function mapToEntity(NewMovieRequest $request, Movie $movie): void
    {
        $movie
            ->setTitle($request->getTitle())
            ->setDescription($request->getDescription())
            ->setDuration($request->getDuration())
            ->setRating($request->getRating())
            ->setYear($request->getYear())
            ->setTagline($request->getTagline());
    }

    public static function mapGenres(Movie $movie): array
    {
        return $movie->getGenres()
            ->map(fn (Genres $genres) => new GenreModel(
                $genres->getId(),
                $genres->getName()
            ))
            ->toArray();
    }
}
