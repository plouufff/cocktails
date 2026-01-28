<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures;

use App\Entity\Cocktail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CocktailFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['test'];
    }

    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'name' => 'collins',
                'recipe' => 'collins-recipe',
            ],
            [
                'name' => 'caïpirinha',
                'recipe' => 'caïpirinha-recipe',
            ],
        ];

        foreach ($data as $cocktail) {
            $newCocktail = new Cocktail()
                ->setName($cocktail['name'])
                ->setRecipe($cocktail['recipe']);

            $manager->persist($newCocktail);
        }
        $manager->flush();
    }
}
