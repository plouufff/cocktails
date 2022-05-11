<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CocktailIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=CocktailIngredientRepository::class)
 */
class CocktailIngredient
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cocktail::class, inversedBy="cocktailIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Cocktail $cocktail;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $measure;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="cocktailIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Ingredient $ingredient;

    public function __toString(): string
    {
        if (null !== $this->ingredient && null !== $this->quantity && null !== $this->measure) {
            return sprintf("%s %s %s", $this->ingredient->getName(), $this->quantity, $this->measure);
        }

        return $this->ingredient->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCocktail(): ?Cocktail
    {
        return $this->cocktail;
    }

    public function setCocktail(?Cocktail $cocktail): self
    {
        $this->cocktail = $cocktail;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(?string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
