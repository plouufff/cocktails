<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\CocktailIngredient;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CocktailIngredientApiNormalizer implements NormalizerInterface
{
    public function normalize(mixed $data, ?string $format = null, array $context = []): array
    {
        if (!$data instanceof CocktailIngredient) {
            return [];
        }

        $normalizedData = ['name' => $data->getIngredient()->getName()];

        if (isset($context['groups']) && in_array('cocktail:details', $context['groups'])) {
            $normalizedData['quantity'] = $data->getQuantity();
            $normalizedData['measure'] = $data->getMeasure();
        }

        return $normalizedData;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof CocktailIngredient;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            CocktailIngredient::class => true,
        ];
    }
}
