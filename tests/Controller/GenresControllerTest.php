<?php

namespace Controller;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use AbstractControllerTest;

class GenresControllerTest extends AbstractControllerTest
{

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function testAllGenres()
    {
        $this->client->request('GET', '/api/v1/genres');

        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();

        $this->assertJsonDocumentMatchesSchema(
            jsonDocument: $responseContent,
            schema: [
                'type' => 'array',
                'items' => [
                    'type' => 'object',
                    'required' => ['id', 'name'],
                    'properties' => [
                        'id' => ['type' => 'integer'],
                        'name' => ['type' => 'string']
                    ]
                ]
            ]
        );
    }
}
