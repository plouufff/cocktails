<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\OneToMany(targetEntity=CocktailIngredient::class, mappedBy="ingredient", orphanRemoval=true)
     */
    private Collection $cocktailIngredients;

    /**
     * @ORM\ManyToOne(targetEntity=IngredientCategory::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?IngredientCategory $ingredientCategory;

    public function __construct()
    {
        $this->cocktailIngredients = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCocktailIngredients(): Collection
    {
        return $this->cocktailIngredients;
    }

    public function addCocktailIngredient(CocktailIngredient $cocktailIngredient): self
    {
        if (!$this->cocktailIngredients->contains($cocktailIngredient)) {
            $this->cocktailIngredients[] = $cocktailIngredient;
            $cocktailIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeCocktailIngredient(CocktailIngredient $cocktailIngredient): self
    {
        if ($this->cocktailIngredients->removeElement($cocktailIngredient)) {
            // set the owning side to null (unless already changed)
            if ($cocktailIngredient->getIngredient() === $this) {
                $cocktailIngredient->setIngredient(null);
            }
        }

        return $this;
    }

    public function getIngredientCategory(): ?IngredientCategory
    {
        return $this->ingredientCategory;
    }

    public function setIngredientCategory(?IngredientCategory $ingredientCategory): self
    {
        $this->ingredientCategory = $ingredientCategory;

        return $this;
    }
}
