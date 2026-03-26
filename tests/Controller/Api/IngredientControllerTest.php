<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IngredientControllerTest extends WebTestCase
{
    public function testListCocktailsByIngredientSuccess(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/ingredients/gin/cocktails');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            json_encode([
                [
                    'id' => 1,
                    'name' => 'collins',
                    'slug' => 'collins',
                    'ingredients' => ['gin', 'jus de citron', 'sirop de sucre de canne', 'perrier', 'menthe', 'citron'],
                ],
            ])
        );
    }

    public function testListCocktailsByIngredientNotFound(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->catchExceptions(false);

        $this->expectException(NotFoundHttpException::class);

        $client->request('GET', '/ingredients/not-found/cocktails');
        $this->assertJsonStringEqualsJsonString($client->getResponse()->getContent(), json_encode(''));
    }
}
