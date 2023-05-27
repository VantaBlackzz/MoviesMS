<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\GenresRepository;
use App\Model\Genre as GenreModel;
use App\Mapper\GenresMapper;
use App\Entity\Genres;

class GenresService
{
    public function __construct(private readonly GenresRepository $genresRepository)
    {
    }

    public function getAllGenres(): array
    {
        return
            array_map(
                function (Genres $genres) {
                    $genresModel = new GenreModel();

                    GenresMapper::mapToModel($genres, $genresModel);

                    return $genresModel;
                },

                $this->genresRepository->findAll()
            );

    }
}
