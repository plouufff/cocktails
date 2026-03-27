<?php

declare(strict_types=1);

namespace App\Dto;

class CocktailSearchDto
{
    public function __construct(
        public readonly ?string $ingredient,
        public readonly bool $alcoholFree = false,
    ) {
    }
}
