<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures;

use App\Entity\Cocktail;
use App\Entity\CocktailIngredient;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CocktailIngredientFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['test'];
    }

    public function load(ObjectManager $manager): void
    {
        $cocktailsIngredients = [
            ['cocktail' => 'collins', 'ingr' => 'gin', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'collins', 'ingr' => 'jus de citron', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'collins', 'ingr' => 'sirop de sucre de canne', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'collins', 'ingr' => 'perrier', 'qty' => 20, 'measure' => 'cl'],
            ['cocktail' => 'collins', 'ingr' => 'menthe', 'qty' => 1, 'measure' => 'feuille'],
            ['cocktail' => 'collins', 'ingr' => 'citron', 'qty' => 1, 'measure' => 'tranche'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'cachaça', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'sirop de sucre de canne', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'citron vert', 'qty' => 1, 'measure' => null],
        ];

        foreach ($cocktailsIngredients as $cocktailsIngredient) {
            $cocktail = $manager->getRepository(Cocktail::class)->findOneBy(
                ['name' => $cocktailsIngredient['cocktail']]
            );
            $ingredient = $manager->getRepository(Ingredient::class)->findOneBy(
                ['name' => $cocktailsIngredient['ingr']]
            );
            $newCocktailIngredient = new CocktailIngredient()
                ->setCocktail($cocktail)
                ->setIngredient($ingredient)
                ->setQuantity($cocktailsIngredient['qty'])
                ->setMeasure($cocktailsIngredient['measure']);
            $manager->persist($newCocktailIngredient);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            IngredientFixtures::class,
            CocktailFixtures::class,
        ];
    }
}
