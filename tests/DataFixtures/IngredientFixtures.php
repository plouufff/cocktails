<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['test'];
    }

    public function load(ObjectManager $manager): void
    {
        $data = [
            'alcohol' => ['cointreau', 'gin', 'cachaça', 'rhum blanc', 'tequila', 'vodka'],
            'soft' => ['perrier', 'tonic', 'cola'],
            'fruit_and_vegetable' => [
                'citron', 'jus de citron', 'citron vert', 'menthe', 'ananas', 'noix de coco râpée', 'lait de coco',
                'jus d\'ananas', 'ananas', 'jus de tomate', 'sel de céleri',
            ],
            'other' => ['cassonade', 'sirop de sucre de canne', 'sucre de canne', 'tabasco', 'worcestershire sauce'],
        ];

        foreach ($data as $category => $ingredients) {
            $category = str_replace('_', ' ', $category);
            $category = $manager->getRepository(IngredientCategory::class)->findOneBy(['name' => $category]);

            foreach ($ingredients as $ingredient) {
                $newIngredient = new Ingredient()
                    ->setName($ingredient)
                    ->setIngredientCategory($category);
                $manager->persist($newIngredient);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            IngredientCategoryFixtures::class,
        ];
    }
}
