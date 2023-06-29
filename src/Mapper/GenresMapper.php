<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\Genre as GenreModel;
use App\Entity\Genres;
use App\Model\GenresList as GenreListModel;

class GenresMapper
{
    public static function mapToModel(Genres $genres, GenreListModel $genresList): void
    {
        $genresList
            ->setId($genres->getId())
            ->setName($genres->getName());
    }
}
