<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\Genre as GenreModel;
use App\Entity\Genres;

class GenresMapper
{
    public static function mapToModel(Genres $genres, GenreModel $genresModel): void
    {
        $genresModel
            ->setId($genres->getId())
            ->setName($genres->getName());
    }
}
