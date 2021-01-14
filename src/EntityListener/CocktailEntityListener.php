<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Cocktail;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class CocktailEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Cocktail $cocktail, LifecycleEventArgs $event)
    {
        $cocktail->computeSlug($this->slugger);
    }

    public function preUpdate(Cocktail $cocktail, LifecycleEventArgs $event)
    {
        $cocktail->computeSlug($this->slugger);
    }
}
