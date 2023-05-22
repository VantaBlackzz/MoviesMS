<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\ErrorResponse;
use App\Model\MovieDetails;
use App\Service\MovieService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MoviesController extends AbstractController
{
    public function __construct(private readonly MovieService $movieService)
    {
    }

    #[OA\Response(
        response: 200,
        description: 'Return movie details by id',
        attachables: [new Model(type: MovieDetails::class)]
    )]
    #[OA\Response(
        response: 404,
        description: 'Movie not found',
        attachables: [new Model(type: ErrorResponse::class)]
    )]
    #[OA\Tag(name: 'Movie', description: 'Get movie by id')]
    #[Route(path: 'api/v1/movie/{id}', methods: ['GET'])]
    public function movie(int $id): Response
    {
        return $this->json($this->movieService->getMovieById($id));
    }
}
