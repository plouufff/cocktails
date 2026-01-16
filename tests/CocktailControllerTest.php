<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CocktailControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/cocktails');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('nav strong', 'Cocktails !');
    }

    public function testShowSuccess(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/cocktail/caipirinha');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Caïpirinha');
    }

    public function testShowFailure(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        $this->expectException(NotFoundHttpException::class);
        $client->request('GET', '/cocktail/failure');
    }
}
