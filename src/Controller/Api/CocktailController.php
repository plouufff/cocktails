<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Dto\CocktailSearchDto;
use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use App\Serializer\CocktailApiNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
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
    public function list(#[MapQueryString] CocktailSearchDto $cocktailSearchDto): JsonResponse
    {
        $normalizedData = array_map(
            fn ($cocktail): array => $this->normalizer->normalize($cocktail),
            $this->cocktails->search($cocktailSearchDto)
        );

        return $this->json($normalizedData);
    }

    #[Route('/{slug:cocktail}', name: 'get')]
    public function get(Cocktail $cocktail): JsonResponse
    {
        $normalizedData = $this->normalizer->normalize($cocktail, 'json', ['groups' => ['cocktail:details']]);

        return $this->json($normalizedData);
    }
}
