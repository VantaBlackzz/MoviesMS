<?php

declare(strict_types=1);

namespace App\Service;

use App\Mapper\MovieMapper;
use App\Model\MovieDetails;
use App\Repository\MovieRepository;

class MovieService
{
    public function __construct(
        private readonly MovieRepository $movieRepository
    ) {
    }

    public function getMovieById(int $id): MovieDetails
    {
        $movie = $this->movieRepository->getMovieById($id);

        $movieDetails = new MovieDetails();

        MovieMapper::map($movie, $movieDetails);

        return $movieDetails;
    }
}
