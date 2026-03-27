<?php

declare(strict_types=1);

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailControllerTest extends WebTestCase
{
    public function testList(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/cocktails');

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
                [
                    'id' => 2,
                    'name' => 'caïpirinha',
                    'slug' => 'caipirinha',
                    'ingredients' => ['cachaça', 'sirop de sucre de canne', 'citron vert'],
                ],
            ])
        );
    }

    public function testListWithIngredientQueryParameter(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/cocktails?ingredient=gin');

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

    public function testGetSuccess(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->request(method: 'GET', uri: '/cocktails/caipirinha');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            json_encode([
                'id' => 2,
                'name' => 'caïpirinha',
                'recipeSteps' => [
                    'caïpirinha-recipe-step1',
                    'caïpirinha-recipe-step2',
                ],
                'slug' => 'caipirinha',
                'ingredients' => [
                    ['measure' => 'maxi', 'quantity' => 2, 'name' => 'cachaça'],
                    ['measure' => 'maxi', 'quantity' => 1, 'name' => 'sirop de sucre de canne'],
                    ['measure' => null, 'quantity' => 1, 'name' => 'citron vert'],
                ],
            ])
        );
    }

    public function testGetNotFound(): void
    {
        $client = static::createClient(server: ['HTTP_HOST' => 'api.test.domain']);
        $client->catchExceptions(false);

        $this->expectException(NotFoundHttpException::class);

        $client->request('GET', '/cocktails/failure');
        $this->assertJsonStringEqualsJsonString($client->getResponse()->getContent(), json_encode(''));
    }
}
