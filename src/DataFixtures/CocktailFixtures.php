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
                'recipe' => [
                    'Verser le gin, le jus de citron et le sirop de sucre de canne dans le verre de préparation',
                    'Remuer doucement',
                    'Verser dans le verre et compléter avec du perrier et des glaçons',
                    'Décorer avec une rondelle de citron et une feuille de menthe',
                ],
            ],
            [
                'name' => 'gin tonic',
                'recipe' => [
                    'Verser le gin et jus de citron dans le shaker rempli de glace',
                    'Frapper',
                    'Verser dans le verre et compléter avec du tonic et de la glace',
                    'Décorer avec une rondelle de citron vert et une paille',
                ],
            ],
            [
                'name' => 'caïpirinha',
                'recipe' => [
                    'Couper le citron en deux et retirer les parties blanches (amères)',
                    'Écraser le citron directement dans le verre et mélanger avec le sirop de sucre de canne',
                    'Ajouter les glaçons',
                    'Mettre la cachaça',
                ],
            ],
            [
                'name' => 'cuba libre',
                'recipe' => [
                    'Verser le rhum et le jus de citron dans un tumbler avec de la glace pilée',
                    'Compléter avec le cola',
                    'Décorer avec une tranche de citron',
                ],
            ],
            [
                'name' => 'mojito',
                'recipe' => [
                    'Dans le shaker, couper le demi-citron en quatre',
                    'Presser à l\'aide d\'un pilon en ajoutant le sucre',
                    'Verser le rhum',
                    'Couper la menthe en morceaux',
                    'Presser légèrement avec le pilon',
                    'Agiter le shaker',
                    'Verser dans le verre et compléter avec du perrier',
                    'Décorer avec des feuilles de menthe non préssées',
                ],
            ],
            [
                'name' => 'piña colada',
                'recipe' => [
                    'Verser le rhum, le lait de coco, le jus d\'ananas et les morceaux d\'ananas dans un mixeur',
                    'Ajouter de la glace pilée et mixer le tout pour avoir un mélanger crémeux',
                    'Verser dans un verre glacé',
                    'Décorer avec un quartier de tranche d\'ananas',
                ],
            ],
            [
                'name' => 'bloody mary',
                'recipe' => [
                    'Verser dans le verre la vodka, le jus de citron, le jus de tomate, le tabasco, la Worcestershire sauce et une pincée de sel de céleri',
                    'Ajouter des glaçons',
                ],
            ],
            [
                'name' => 'margarita',
                'recipe' => [
                    'Verser la cassonade puis la tequila, le Cointreau, le jus d\'ananas, le lait de coco et la noix de coco râpée dans
                    le shaker rempli de glaçe',
                    'Agiter pendant 15 à 20 secondes',
                    'Verser dans le verre en retenant les glaçons',
                    'Frotter le bord du verre avec un quart de citron et givrer avec du sel',
                ],
            ],
            [
                'name' => 'daiquiri',
                'recipe' => [
                    'Verser le rhum, le sirop de sucre et le jus de citron dans le shaker rempli de glaçe',
                    'Frapper avec les glaçons',
                    'Verser dans le verre glacé',
                    'Décorer avec une tranche de citron',
                ],
            ],
        ];

        foreach ($data as $cocktail) {
            $newCocktail = new Cocktail()
                ->setName($cocktail['name'])
                ->setRecipeSteps($cocktail['recipe']);

            $manager->persist($newCocktail);
        }
        $manager->flush();
    }
}
