<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Cocktail;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CocktailApiNormalizer implements NormalizerInterface
{
    public function __construct(
        private readonly CocktailIngredientApiNormalizer $cocktailIngredientApiNormalizer,
    ) {
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array
    {
        if (!$data instanceof Cocktail) {
            return [];
        }

        $mapIngredient = function ($cocktailIngredient) use ($format, $context): array|string {
            if (isset($context['groups']) && in_array('cocktail:details', $context['groups'])) {
                return $this->cocktailIngredientApiNormalizer->normalize($cocktailIngredient, $format, $context);
            }

            return $cocktailIngredient->getIngredient()->getName();
        };

        $normalizedData = [
            'id' => $data->getId(),
            'name' => $data->getName(),
            'slug' => $data->getSlug(),
            'ingredients' => array_map(
                $mapIngredient,
                $data->getCocktailIngredients()->getValues()
            ),
        ];

        if (isset($context['groups']) && in_array('cocktail:details', $context['groups'])) {
            $normalizedData['recipeSteps'] = $data->getRecipeSteps();
        }

        return $normalizedData;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Cocktail;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Cocktail::class => true,
        ];
    }
}
