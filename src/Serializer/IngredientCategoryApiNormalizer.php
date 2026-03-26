<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class IngredientCategoryApiNormalizer implements NormalizerInterface
{
    public function normalize(mixed $data, ?string $format = null, array $context = []): array
    {
        if (!$data instanceof IngredientCategory) {
            return [];
        }

        $normalizedData = ['name' => $data->getName()];

        if (isset($context['groups']) && in_array('ingredient-category:details', $context['groups'])) {
            $normalizedData['ingredients'] = array_map(
                fn (Ingredient $ingredient) => [
                    'name' => $ingredient->getName(),
                    'slug' => $ingredient->getSlug(),
                ],
                $data->getIngredients()->getValues()
            );
        }

        return $normalizedData;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof IngredientCategory;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            IngredientCategory::class => true,
        ];
    }
}
