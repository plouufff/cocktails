<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\IngredientCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categoryNames = ['soft', 'alcohol', 'fruit and vegetable', 'other'];
        foreach ($categoryNames as $categoryName) {
            $category = new IngredientCategory();
            $category->setName($categoryName);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
