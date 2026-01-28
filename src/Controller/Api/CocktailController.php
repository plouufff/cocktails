<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use App\Serializer\CocktailApiNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cocktails', name: 'api_cocktails_', methods: ['GET'])]
class CocktailController extends AbstractController
{
    public function __construct(
        private readonly CocktailRepository $cocktails,
        private readonly CocktailApiNormalizer $normalizer,
    ) {
    }

    #[Route(name: 'list')]
    public function getAllCocktails(): JsonResponse
    {
        $cocktails = $this->cocktails->findAll();

        $normalizedData = array_map(
            fn ($cocktail): array => $this->normalizer->normalize($cocktail),
            $this->cocktails->findAll()
        );

        return $this->json($normalizedData);
    }

    #[Route('/{slug:cocktail}', name: 'get')]
    public function getCocktail(Cocktail $cocktail): JsonResponse
    {
        $normalizedData = $this->normalizer->normalize($cocktail, 'json', ['groups' => ['cocktail:details']]);

        return $this->json($normalizedData);
    }
}
