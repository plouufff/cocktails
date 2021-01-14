<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Cocktail;
use App\Entity\CocktailIngredient;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CocktailIngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $cocktailsIngredients = [
            ['cocktail' => 'collins', 'ingr' => 'gin', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'collins', 'ingr' => 'jus de citron', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'collins', 'ingr' => 'sirop de sucre de canne', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'collins', 'ingr' => 'perrier', 'qty' => 20, 'measure' => 'cl'],
            ['cocktail' => 'collins', 'ingr' => 'menthe', 'qty' => 1, 'measure' => 'feuille'],
            ['cocktail' => 'collins', 'ingr' => 'citron', 'qty' => 1, 'measure' => 'tranche'],
            ['cocktail' => 'gin tonic', 'ingr' => 'gin', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'gin tonic', 'ingr' => 'citron vert', 'qty' => 1, 'measure' => 'tranche'],
            ['cocktail' => 'gin tonic', 'ingr' => 'tonic', 'qty' => 20, 'measure' => 'cl'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'cachaça', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'sirop de sucre de canne', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'caïpirinha', 'ingr' => 'citron vert', 'qty' => 1, 'measure' => null],
            ['cocktail' => 'cuba libre', 'ingr' => 'rhum blanc', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'cuba libre', 'ingr' => 'jus de citron', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'cuba libre', 'ingr' => 'cola', 'qty' => 20, 'measure' => 'cl'],
            ['cocktail' => 'cuba libre', 'ingr' => 'citron', 'qty' => 1, 'measure' => 'tranche'],
            ['cocktail' => 'mojito', 'ingr' => 'rhum blanc', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'mojito', 'ingr' => 'citron vert', 'qty' => 1, 'measure' => 'moitié'],
            ['cocktail' => 'mojito', 'ingr' => 'sucre de canne', 'qty' => 1, 'measure' => 'cuillère à café'],
            ['cocktail' => 'mojito', 'ingr' => 'menthe', 'qty' => 8, 'measure' => 'feuille'],
            ['cocktail' => 'mojito', 'ingr' => 'perrier', 'qty' => 20, 'measure' => 'cl'],
            ['cocktail' => 'piña colada', 'ingr' => 'rhum blanc', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'piña colada', 'ingr' => 'lait de coco', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'piña colada', 'ingr' => 'jus d\'ananas', 'qty' => 3, 'measure' => 'maxi'],
            ['cocktail' => 'piña colada', 'ingr' => 'ananas', 'qty' => 4, 'measure' => 'morceaux'],
            ['cocktail' => 'bloody mary', 'ingr' => 'vodka', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'bloody mary', 'ingr' => 'jus de citron', 'qty' => 2, 'measure' => 'cuillère à café'],
            ['cocktail' => 'bloody mary', 'ingr' => 'worcestershire sauce', 'qty' => 1, 'measure' => 'cuillère à café'],
            ['cocktail' => 'bloody mary', 'ingr' => 'tabasco', 'qty' => 10, 'measure' => 'goutte'],
            ['cocktail' => 'bloody mary', 'ingr' => 'jus de tomate', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'bloody mary', 'ingr' => 'sel de céleri', 'qty' => 1, 'measure' => 'pincée'],
            ['cocktail' => 'margarita', 'ingr' => 'tequila', 'qty' => 2, 'measure' => 'maxi'],
            ['cocktail' => 'margarita', 'ingr' => 'cointreau', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'margarita', 'ingr' => 'jus de citron', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'margarita', 'ingr' => 'lait de coco', 'qty' => 1, 'measure' => 'maxi'],
            ['cocktail' => 'margarita', 'ingr' => 'jus d\'ananas', 'qty' => 5, 'measure' => 'maxi'],
            ['cocktail' => 'margarita', 'ingr' => 'noix de coco râpée', 'qty' => 1, 'measure' => 'cuillère à café'],
            ['cocktail' => 'margarita', 'ingr' => 'cassonade', 'qty' => 1, 'measure' => 'cuillère à café'],
            ['cocktail' => 'margarita', 'ingr' => 'citron', 'qty' => 1, 'measure' => 'quart'],
            ['cocktail' => 'daiquiri', 'ingr' => 'rhum blanc', 'qty' => 1, 'measure' => 'maxi et demi'],
            ['cocktail' => 'daiquiri', 'ingr' => 'jus de citron', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'daiquiri', 'ingr' => 'sirop de sucre de canne', 'qty' => 1, 'measure' => 'baby'],
            ['cocktail' => 'daiquiri', 'ingr' => 'citron', 'qty' => 1, 'measure' => null],
        ];

        foreach ($cocktailsIngredients as $cocktailsIngredient) {
            $cocktail = $manager->getRepository(Cocktail::class)->findOneBy(
                ['name' => $cocktailsIngredient['cocktail']]
            );
            $ingredient = $manager->getRepository(Ingredient::class)->findOneBy(
                ['name' => $cocktailsIngredient['ingr']]
            );
            $newCocktailIngredient = (new CocktailIngredient())
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
            CocktailFixtures::class
        ];
    }
}
