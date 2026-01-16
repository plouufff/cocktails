<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Cocktail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CocktailApiNormalizer implements NormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private readonly NormalizerInterface $normalizer
    ) {
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array
    {
        if (!$data instanceof Cocktail) {
            return [];
        }

        $normalizedData = [
            'id' => $data->getId(),
            'name' => $data->getName(),
            'slug' => $data->getSlug(),
        ];

        if (isset($context['groups']) && in_array('cocktail:details', $context['groups'])) {
            $normalizedData['recipe'] = $data->getRecipe();

            $mapIngredients = function ($cocktailIngredient): array {
                return [
                    'name' => $cocktailIngredient->getIngredient()->getName(),
                    'quantity' => $cocktailIngredient->getQuantity(),
                    'measure' => $cocktailIngredient->getMeasure(),
                ];
            };

            $normalizedData['ingredients'] = array_map(
                $mapIngredients,
                $data->getCocktailIngredients()->getValues()
            );
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
