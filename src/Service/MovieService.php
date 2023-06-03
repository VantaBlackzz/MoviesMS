<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\{MovieDetails, IdResponse};
use App\Exception\MovieNotFoundException;
use App\Repository\MovieRepository;
use App\RequestDTO\NewMovieRequest;
use App\Mapper\MovieMapper;
use App\Entity\Movie;

final readonly class MovieService
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {
    }

    public function getMovieById(int $id): MovieDetails
    {
        $movie = $this->movieRepository->find($id);

        if (null === $movie) {
            throw new MovieNotFoundException();
        }

        $movieDetails = new MovieDetails();

        MovieMapper::mapToModel($movie, $movieDetails);

        return $movieDetails->setGenres(MovieMapper::mapGenres($movie));
    }

    public function addMovieInCollection(NewMovieRequest $request): IdResponse
    {
        $newMovie = new Movie();

        MovieMapper::mapToEntity($request, $newMovie);

        $this->movieRepository->addMovie($newMovie);

        return new IdResponse($newMovie->getId());
    }

    public function removeMovie(int $id): void
    {
        $movie = $this->movieRepository->find($id);

        if (null === $movie) {
            throw new MovieNotFoundException();
        }

        $this->movieRepository->remove($movie);
    }

    public function getAllMovies(): array
    {
        return
            array_map(
                function (Movie $movie) {
                    $movieModel = new MovieDetails();

                    MovieMapper::mapToModel($movie, $movieModel);

                    return $movieModel->setGenres(MovieMapper::mapGenres($movie));
                },
                $this->movieRepository->findAll()
        );
    }
}
