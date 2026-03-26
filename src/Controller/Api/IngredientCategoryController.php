<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\IngredientCategory;
use App\Serializer\IngredientCategoryApiNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ingredient-categories', name: 'api_ingredient_categories_', methods: ['GET'])]
class IngredientCategoryController extends AbstractController
{
    public function __construct(
        private readonly IngredientCategoryApiNormalizer $normalizer,
    ) {
    }

    #[Route('/{name:ingredientCategory}', name: 'get')]
    public function get(IngredientCategory $ingredientCategory): JsonResponse
    {
        $normalizedData = $this->normalizer->normalize($ingredientCategory, 'json', ['groups' => ['ingredient-category:details']]);

        return $this->json($normalizedData);
    }
}
