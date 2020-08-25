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

class h_SupplierFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $supplier = new Suppliers();
            $picture = new Picture();
            $address = new Address();
            $product = new Product();
            $theme = new Theme();


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
            $manager->persist($supplier);
            $manager->persist($address);
            $manager->persist($product);
            $manager->persist($theme);



        }

        $manager->flush();
    }

}