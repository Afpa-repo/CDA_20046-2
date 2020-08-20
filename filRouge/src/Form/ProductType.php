<?php

namespace App\Form;

use App\Entity\Format;
use App\Entity\Material;
use App\Entity\Product;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proName' , TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Produit',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('proStockAle' , TextType::class, [
                'label' => 'Alerte Stock',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('proUnitPrice' , TextType::class, [
                'label' => 'Prix unitaire',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('ProUnitStockPhy' , TextType::class, [
                'label' => 'Unité en commande',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('proUnitOnOrder' , TextType::class, [
                'label' => 'Unité en commande',
                'attr' => [
                    'placeholder' => '',
                ],
            ] )
            ->add('proDiscontinued' , TextType::class, [
                'label' => 'Discontinued',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('proNote' , TextType::class, [
                'label' => 'Note du produit',
                'attr' => [
                    'placeholder' => 'Libellé',
                ],
            ])
            ->add('proLib' , TextType::class, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('proDescription' , TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => '',
                ],
            ])

            ->add('material', EntityType::class, [
                'class' => Material::class,
                'label' => "Matériel pour l'affiche",
                'expanded'  => true,
                'multiple'  => true,
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('format', EntityType::class, [
                'class' => Format::class,
                'label' => 'Format',
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'label' => "Theme de l'affiche",
                'expanded'  => true,
                'multiple'  => true,
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('imageFile', VichImageType::class)
;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
