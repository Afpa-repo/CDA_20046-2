<?php


namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Material;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Suppliers;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class i_MaterialFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 4; $i++) {
            $material = new Material();
            $supplier = new Suppliers();
            $material = new Material();
            $picture = new Picture();
            $address = new Address();
            $theme = new Theme();
            $product = new Product();


            $material->setMaterialName("Matos n°$i");
            $material->setSupplier($supplier);

            $theme->setThemeName("Thème n°$i");

            $supplier->setAdress($address);
            $supplier->setSuppliCompanyName("Beuhnana n°$i");
            $supplier->setSuppliMail("Beuhnana$i@gmail.pom");
            $supplier->setSuppliPhone("666-666-6$i");
            $supplier->setPicture($picture);

            $address->setAddressType("$i");
            $address->setAddressCountry("France $i");
            $address->setAddressDistrict("Somme $i");
            $address->setAddressPostalCode("80000");
            $address->setAddressCity("Amiens $i");
            $address->setAddressNumStreet(rand(1, 100));
            $address->setAddressStreet("rue des cornichons $i");
            $address->setAddressComplement("Près du chapiteau !!! $i");

            $manager->persist($material);
            $manager->persist($supplier);
            $manager->persist($picture);
            $manager->persist($address);

            $product->setProName("produit n°$i");
            $product->setProNote($i + 1);
            $product->setProLib("Libellé n°$i");
            $product->setProDescription("<h3>Description du produit n°$i</h3><p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </p>");
            $product->setTheme($theme);

            $picture->setName("https://picsum.photos/297/300");
            $picture->setProduct($product);

            $material->setMaterialName("Matos n°$i");


            $manager->persist($picture);
            $manager->persist($theme);
            $manager->persist($product);
            $manager->persist($material);
            $manager->persist($supplier);
            $manager->persist($theme);


        }

        $manager->flush();
    }

}