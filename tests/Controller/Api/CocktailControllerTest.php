<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/cocktails');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString($client->getResponse()->getContent(), json_encode([
            ['id' => 1, 'name' => 'collins', 'slug' => 'collins'],
            ['id' => 2, 'name' => 'caïpirinha', 'slug' => 'caipirinha']
        ]));
    }

    public function testShowSuccess(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/cocktails/caipirinha');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            json_encode([
                'id' => 2,
                'name' => 'caïpirinha',
                'recipe' => 'caïpirinha-recipe',
                'slug' => 'caipirinha',
                'ingredients' => [
                    ['measure' => 'maxi', 'quantity' => 2, 'name' => 'cachaça'],
                    ['measure' => 'maxi', 'quantity' => 1, 'name' => 'sirop de sucre de canne'],
                    ['measure' => null, 'quantity' => 1, 'name' => 'citron vert'],
                ],
            ])
        );
    }

    public function testShowFailure(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->catchExceptions(false);

        $this->expectException(NotFoundHttpException::class);

        $client->request('GET', '/cocktails/failure');
        $this->assertJsonStringEqualsJsonString($client->getResponse()->getContent(), json_encode(''));
    }
}
