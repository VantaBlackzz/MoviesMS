<?php

namespace Controller;

use AbstractControllerTest;

class MoviesControllerTest extends AbstractControllerTest
{
    public function testMovies()
    {
        $this->client->request('GET','api/v1/movies');

        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();

        $this->assertJsonDocumentMatchesSchema(
            jsonDocument: $responseContent,
            schema: [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'required' => ['title', 'description', 'genres', 'tagline', 'year', 'rating', 'duration'],
                    'properties' => [
                        'title' => 'string',
                        'description' => 'string',
                        'genres' => 'array',
                            'items' => [
                                'type' => 'object',
                                'required' => ['id', 'name'],
                                'properties' => [
                                    'id' => 'integer',
                                    'name' => 'string'
                                ]
                            ],
                        'tagline' => 'string',
                        'year' => 'integer',
                        'rating' => 'number',
                        'duration' => 'integer'
                    ]
                ]
            ]
        );
    }

    public function testGetMovieById()
    {
        $this->client->request('GET', 'api/v1/movie/1');

        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();

        $this->assertJsonDocumentMatchesSchema(
            jsonDocument: $responseContent,
            schema: [
                'type' => 'object',
                'required' => ['title', 'description', 'genres', 'tagline', 'year', 'rating', 'duration'],
                'properties' => [
                    'title' => 'string',
                    'description' => 'string',
                    'genres' => 'array',
                    'items' => [
                        'type' => 'object',
                        'required' => ['id', 'name'],
                        'properties' => [
                            'id' => 'integer',
                            'name' => 'string'
                        ]
                    ],
                    'tagline' => 'string',
                    'year' => 'integer',
                    'rating' => 'number',
                    'duration' => 'integer'
                ]
            ]
        );
    }
}
