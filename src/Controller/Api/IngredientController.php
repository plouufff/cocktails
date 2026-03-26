<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Ingredient;
use App\Repository\CocktailRepository;
use App\Serializer\CocktailApiNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ingredients', name: 'api_ingredients_', methods: ['GET'])]
class IngredientController extends AbstractController
{
    public function __construct(
        private readonly CocktailRepository $cocktails,
        private readonly CocktailApiNormalizer $normalizer,
    ) {
    }

    #[Route('/{name:ingredient}/cocktails', name: 'list_cocktails_by_ingredient')]
    public function listCocktailsByIngredient(Ingredient $ingredient): JsonResponse
    {
        $normalizedData = array_map(
            fn ($cocktail): array => $this->normalizer->normalize($cocktail),
            $this->cocktails->findByIngredient($ingredient),
        );

        return $this->json($normalizedData);
    }
}
