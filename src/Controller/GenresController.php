<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Service\GenresService;
use OpenApi\Attributes as OA;
use App\Model\Genre;

class GenresController extends AbstractController
{
    public function __construct(
        private readonly GenresService $genresService
    ) {
    }

    #[OA\Response(
        response: 200,
        description: 'list of all genres',
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Genre::class))
        ),
    )]
    #[OA\Tag(name: 'Genres')]
    #[Route(path: 'api/v1/genres', methods: ['GET'])]
    public function allGenres(): Response
    {
        return $this->json($this->genresService->getAllGenres());
    }
}
