<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Cocktail;
use App\Serializer\CocktailApiNormalizer;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CocktailController extends AbstractController
{
    public function __construct(
        private readonly CocktailRepository $cocktails,
        private readonly CocktailApiNormalizer $normalizer,
    ) {
    }

    #[Route('/cocktails', methods: ['GET'])]
    public function getAllCocktails(): JsonResponse
    {
        $cocktails = $this->cocktails->findAll();

        $normalizedData = array_map(
            fn($cocktail): array => $this->normalizer->normalize($cocktail),
            $this->cocktails->findAll()
        );

        return $this->json($normalizedData);
    }

    #[Route('/cocktails/{slug:cocktail}', methods: ['GET'])]
    public function getCocktail(Cocktail $cocktail): JsonResponse
    {
        $normalizedData = $this->normalizer->normalize($cocktail, 'json', ['groups' => ['cocktail:details']]);

        return $this->json($normalizedData);
    }
}
