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

            ->add('Theme', EntityType::class, [
                'label' => "Theme de l'image",
                'required' => false,
                'class' => Theme::class,
            ])

            ->add('picture', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])


;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
