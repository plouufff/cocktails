<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CocktailController extends AbstractController
{
    private Environment $twig;
    private EntityManagerInterface $entityManager;
    private CocktailRepository $cocktails;

    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        CocktailRepository $cocktails
    ) {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->cocktails = $cocktails;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $cocktails = $this->entityManager->getRepository(Cocktail::class)->findAll();

        return $this->render('cocktail/index.html.twig', ['cocktails' => $cocktails]);
    }

    /**
     * @Route("/cocktail/random", name="random_cocktail", priority="2")
     */
    public function showRandom(): Response
    {
        $randomCocktail = $this->cocktails->getRandomCocktail();

        return new RedirectResponse($this->generateUrl('cocktail', ['slug' => $randomCocktail->getSlug()]));
    }

    /**
     * @Route("/cocktail/{slug}", name="cocktail")
     */
    public function show(Cocktail $cocktail): Response
    {
        return $this->render('cocktail/show.html.twig', ['cocktail' => $cocktail]);
    }
}
