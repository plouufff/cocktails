<?php

namespace App\Form;

use App\Entity\CocktailIngredient;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient', EntityType::class, ['class' => Ingredient::class, 'label' => 'ingredients.singular'])
            ->add('quantity', NumberType::class, ['label' => 'cocktail_ingredients.quantity'])
            ->add('measure', TextType::class,  ['label' => 'cocktail_ingredients.measure'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CocktailIngredient::class,
        ]);
    }
}
