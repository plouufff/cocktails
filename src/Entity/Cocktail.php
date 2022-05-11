<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CocktailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CocktailRepository::class)
 * @UniqueEntity("slug")
 */
class Cocktail
{
    use TimestampableEntity;

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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private ?string $slug = null;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $recipe;

    /**
     * @ORM\OneToMany(targetEntity=CocktailIngredient::class, mappedBy="cocktail", orphanRemoval=true)
     */
    private Collection $cocktailIngredients;

    public function __toString(): string
    {
        // return $this->name;
        return 'test';
    }

    public function __construct()
    {
        $this->cocktailIngredients = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(string $recipe): self
    {
        $this->recipe = $recipe;

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
            $cocktailIngredient->setCocktail($this);
        }

        return $this;
    }

    public function removeCocktailIngredient(CocktailIngredient $cocktailIngredient): self
    {
        if ($this->cocktailIngredients->removeElement($cocktailIngredient)) {
            // set the owning side to null (unless already changed)
            if ($cocktailIngredient->getCocktail() === $this) {
                $cocktailIngredient->setCocktail(null);
            }
        }

        return $this;
    }
}
