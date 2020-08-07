<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proName')
            ->add('proStockAle')
            ->add('proUnitStockPhy')
            ->add('proUnitOnOrder')
            ->add('proDiscontinued')
            ->add('proNote')
            ->add('proLib')
            ->add('proDescription')
            ->add('proUnitPrice')
            ->add('material')
            ->add('format')
            ->add('theme')
            ->add('orderDetails')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
