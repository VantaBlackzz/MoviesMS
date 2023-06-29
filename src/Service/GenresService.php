<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\GenresList as GenreListModel;
use App\Repository\GenresRepository;
use App\Mapper\GenresMapper;
use App\Entity\Genres;

readonly class GenresService
{
    public function __construct(private GenresRepository $genresRepository)
    {
    }

    public function getAllGenres(): array
    {
        return
            array_map(
                function (Genres $genres) {
                    $genresListModel = new GenreListModel();

                    GenresMapper::mapToModel($genres, $genresListModel);

                    return $genresListModel;
                },
                $this->genresRepository->findAll()
            );
    }
}
