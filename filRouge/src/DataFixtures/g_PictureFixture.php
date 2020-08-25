<?php


namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class g_PictureFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 15; $i++) {
            $picture = new Picture();
            $product = new Product();
            $theme = new Theme();

            $theme->setThemeName("Thème n°$i");

            $picture->setName("https://picsum.photos/297/300");
            $picture->setProduct($product);
            $product->setProName("produit n°$i");
            $product->setProNote($i + 1);
            $product->setProLib("Libellé n°$i");
            $product->setProDescription("<h3>Description du produit n°$i</h3><p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </p>");
            $product->setPicture($picture);
            $product->setTheme($theme);

            $manager->persist($picture);
            $manager->persist($theme);
            $manager->persist($product);

        }

        $manager->flush();
    }

}