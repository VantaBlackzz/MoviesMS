<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Model\{MovieDetails, IdResponse};
use Nelmio\ApiDocBundle\Annotation\Model;
use App\RequestDTO\NewMovieRequest;
use App\Service\MovieService;
use OpenApi\Attributes as OA;
use App\Model\ErrorResponse;

final class MoviesController extends AbstractController
{
    public function __construct(
        private readonly MovieService $movieService,
    ) {
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
    public function getMovieById(int $id): Response
    {
        return $this->json($this->movieService->getMovieById($id));
    }

    #[OA\Response(
        response: 201,
        description: 'movie added in collection',
        attachables: [new Model(type: IdResponse::class)]
    )]
    #[OA\Response(
        response: 400,
        description: 'Validation failed',
        attachables: [new Model(type: ErrorResponse::class)]
    )]
    #[OA\RequestBody(attachables: [new Model(type: NewMovieRequest::class)])]
    #[OA\Tag(name: 'Movie')]
    #[Route(path: 'api/v1/movie', methods: ['POST'])]
    public function addNewMovie(NewMovieRequest $request): Response
    {
        return $this->json($this->movieService->addMovieInCollection($request), Response::HTTP_CREATED);
    }

    #[OA\Response(
        response: 204,
        description: 'movie successfully deleted',
    )]
    #[OA\Response(
        response: 404,
        description: 'movie not found',
        attachables: [new Model(type: ErrorResponse::class)]
    )]
    #[OA\Tag(name: 'Movie')]
    #[Route(path: 'api/v1/movie/{id}', methods: ["DELETE"])]
    public function removeMovie(int $id): Response
    {
        $this->movieService->removeMovie($id);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    #[OA\Response(
        response: 200,
        description: 'retrieve all movies',
        attachables: [new Model(type: MovieDetails::class)]
    )]
    #[OA\Tag(name: 'Movie')]
    #[Route(path: 'api/v1/movies', methods: ['GET'])]
    public function movies(): Response
    {
        return $this->json($this->movieService->getAllMovies());
    }
}
