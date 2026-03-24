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
                'recipeSteps' => [
                    'collins-recipe-step1',
                    'collins-recipe-step2',
                ],
            ],
            [
                'name' => 'caïpirinha',
                'recipeSteps' => [
                    'caïpirinha-recipe-step1',
                    'caïpirinha-recipe-step2',
                ],
            ],
        ];

        foreach ($data as $cocktail) {
            $newCocktail = new Cocktail()
                ->setName($cocktail['name'])
                ->setRecipeSteps($cocktail['recipeSteps']);

            $manager->persist($newCocktail);
        }
        $manager->flush();
    }
}
