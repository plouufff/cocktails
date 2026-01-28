<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Cocktail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\WhenNot;

#[WhenNot(env: 'test')]
class CocktailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'name' => 'collins',
                'recipe' => '<ul>
<li>Verser le gin, le jus de citron et le sirop de sucre de canne dans le verre de préparation</li>
<li>Remuer doucement</li>
<li>Verser dans le verre et compléter avec du perrier et des glaçons</li>
<li>Décorer avec une rondelle de citron et une feuille de menthe</li>
</ul>',
            ],
            [
                'name' => 'gin tonic',
                'recipe' => '<ul>
<li>Verser le gin et jus de citron dans le shaker rempli de glace</li>
<li>Frapper</li>
<li>Verser dans le verre et compléter avec du tonic et de la glace</li>
<li>Décorer avec une rondelle de citron vert et une paille</li>
</ul>',
            ],
            [
                'name' => 'caïpirinha',
                'recipe' => '<ul>
<li>Couper le citron en deux et retirer les parties blanches (amères)</li>
<li>Écraser le citron directement dans le verre et mélanger avec le sirop de sucre de canne</li>
<li>Ajouter les glaçons</li>
<li>Mettre la cachaça</li>
</ul>',
            ],
            [
                'name' => 'cuba libre',
                'recipe' => '<ul>
<li>Verser le rhum et le jus de citron dans un tumbler avec de la glace pilée</li>
<li>Compléter avec le cola</li>
<li>Décorer avec une tranche de citron</li>
</ul>',
            ],
            [
                'name' => 'mojito',
                'recipe' => '<ul>
<li>Dans le shaker, couper le demi-citron en quatre</li>
<li>Presser à l\'aide d\'un pilon en ajoutant le sucre</li>
<li>Verser le rhum</li>
<li>Couper la menthe en morceaux</li>
<li>Presser légèrement avec le pilon</li>
<li>Agiter le shaker</li>
<li>Verser dans le verre et compléter avec du perrier</li>
<li>Décorer avec des feuilles de menthe non préssées</li>
</ul>',
            ],
            [
                'name' => 'piña colada',
                'recipe' => '<ul>
<li>Verser le rhum, le lait de coco, le jus d\'ananas et les morceaux d\'ananas dans un mixeur</li>
<li>Ajouter de la glace pilée et mixer le tout pour avoir un mélanger crémeux</li>
<li>Verser dans un verre glacé</li>
<li>Décorer avec un quartier de tranche d\'ananas</li>
</ul>',
            ],
            [
                'name' => 'bloody mary',
                'recipe' => '<ul>
<li>Verser dans le verre la vodka, le jus de citron, le jus de tomate, le tabasco, la Worcestershire sauce et une
pincée de sel de céleri</li>
<li>Ajouter des glaçons</li>
</ul>',
            ],
            [
                'name' => 'margarita',
                'recipe' => '<ul>
<li>Verser la cassonade puis la tequila, le Cointreau, le jus d\'ananas, le lait de coco et la noix de coco râpée dans
le shaker rempli de glaçe</li>
<li>Agiter pendant 15 à 20 secondes</li>
<li>Verser dans le verre en retenant les glaçons</li>
<li>Frotter le bord du verre avec un quart de citron et givrer avec du sel</li>
</ul>',
            ],
            [
                'name' => 'daiquiri',
                'recipe' => '<ul>
<li>Verser le rhum, le sirop de sucre et le jus de citron dans le shaker rempli de glaçe</li>
<li>Frapper avec les glaçons</li>
<li>Verser dans le verre glacé</li>
<li>Décorer avec une tranche de citron</li>
</ul>',
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
