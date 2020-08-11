<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proName')
            ->add('proStockAle')
            ->add('proUnitPrice')
            ->add('ProUnitStockPhy')
            ->add('proUnitOnOrder')
            ->add('proDiscontinued')
            ->add('proNote')
            ->add('proLib')
            ->add('proDescription')
            ->add('material')
            ->add('format')
            ->add('theme')
            ->add('picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
