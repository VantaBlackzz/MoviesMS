<?php

namespace Service;

use App\Repository\GenresRepository;
use PHPUnit\Framework\TestCase;
use App\Service\GenresService;
use App\Entity\Genres;
use App\Model\Genre;

class GenresServiceTest extends TestCase
{

    public function testGetAllGenres()
    {
        $repository = $this->createMock(GenresRepository::class);
        $repository->expects($this->once())
            ->method('findAll')
            ->willReturn([(new Genres())->setId(1)->setName('test-genre')]);

        $service = new GenresService($repository);

        $expected = [
            (new Genre())->setId(1)->setName('test-genre')
        ];

        $this->assertEquals($expected, $service->getAllGenres());
    }
}
