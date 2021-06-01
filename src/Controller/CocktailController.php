<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CocktailController extends AbstractController
{
    private CocktailRepository $cocktails;

    public function __construct(CocktailRepository $cocktails)
    {
        $this->cocktails = $cocktails;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('cocktail/index.html.twig', ['cocktails' => $this->cocktails->findAll()]);
    }

    /**
     * @Route("/cocktail/random", name="random_cocktail", priority="2")
     */
    public function showRandom(): Response
    {
        return new RedirectResponse(
            $this->generateUrl('cocktail', ['slug' => $this->cocktails->getRandomCocktail()->getSlug()])
        );
    }

    /**
     * @Route("/cocktail/{slug}", name="cocktail")
     */
    public function show(Cocktail $cocktail): Response
    {
        return $this->render('cocktail/show.html.twig', ['cocktail' => $cocktail]);
    }
}
