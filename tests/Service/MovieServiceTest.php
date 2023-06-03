<?php

namespace Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;
use App\Service\MovieService;
use App\Model\MovieDetails;
use App\Entity\Movie;

class MovieServiceTest extends TestCase
{
    private MovieRepository $movieRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movieRepository = $this->createMock(MovieRepository::class);

    }

    public function testGetAllMovies()
    {
        $this->movieRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([(new Movie())
                ->setId(100)
                ->setYear(2024)
                ->setGenres(new ArrayCollection())
                ->setTagline('tagline')
                ->setRating(5)
                ->setDuration(200)
                ->setDescription('description')
                ->setTitle('title')
            ]);

        $service = new MovieService($this->movieRepository);

        $expected = [
            (new MovieDetails())
                ->setYear(2024)
                ->setGenres([])
                ->setTagline('tagline')
                ->setRating(5)
                ->setDuration(200)
                ->setDescription('description')
                ->setTitle('title')
        ];

        $this->assertEquals($expected, $service->getAllMovies());
    }

    public function testGetMovieById()
    {
        $this->movieRepository->expects($this->once())
            ->method('find')
            ->with(50)
            ->willReturn((new Movie())
                ->setId(50)
                ->setTitle('test-title')
                ->setDuration(300)
                ->setDescription('test-description')
                ->setYear(2025)
                ->setRating(1)
                ->setTagline('test-tagline')
                ->setGenres(new ArrayCollection()));

        $service = new MovieService($this->movieRepository);

        $expected = (new MovieDetails())
            ->setTitle('test-title')
            ->setDuration(300)
            ->setDescription('test-description')
            ->setYear(2025)
            ->setRating(1)
            ->setTagline('test-tagline')
            ->setGenres([]);

        $this->assertEquals($expected, $service->getMovieById(50));
    }
}
