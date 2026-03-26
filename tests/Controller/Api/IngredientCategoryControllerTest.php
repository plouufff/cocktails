<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IngredientCategoryControllerTest extends WebTestCase
{
    public function testGetSuccess(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/ingredient-categories/alcohol');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            json_encode([
                'name' => 'alcohol',
                'ingredients' => [
                    ['name' => 'cointreau', 'slug' => 'cointreau'],
                    ['name' => 'gin', 'slug' => 'gin'],
                    ['name' => 'cachaça', 'slug' => 'cachaca'],
                    ['name' => 'rhum blanc', 'slug' => 'rhum-blanc'],
                    ['name' => 'tequila', 'slug' => 'tequila'],
                    ['name' => 'vodka', 'slug' => 'vodka'],
                ],
            ])
        );
    }

    public function testGetNotFound(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->catchExceptions(false);

        $this->expectException(NotFoundHttpException::class);

        $client->request('GET', '/ingredient-categories/not-found');
        $this->assertJsonStringEqualsJsonString($client->getResponse()->getContent(), json_encode(''));
    }
}
