<?php


namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Format;
use App\Entity\Material;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Stock;
use App\Entity\Suppliers;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class j_StockFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $format = new Format();
            $stock = new Stock();
            $material = new Material();
            $supplier = new Suppliers();
            $picture = new Picture();
            $address = new Address();
            $product = new Product();
            $theme = new Theme();






            $picture->setName("https://picsum.photos/297/300");
            $picture->setProduct($product);


            $theme->setThemeName("Thème n°$i");

            $product->setProName("produit n°$i");
            $product->setProNote($i + 1);
            $product->setProLib("Libellé n°$i");
            $product->setProDescription("<h3>Description du produit n°$i</h3><p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </p>");
            $product->setTheme($theme);

            $stock->setFormat($format);
            $format->setFormatName("A$i");

            $material->setMaterialName("Matos n°$i");
            $material->setSupplier($supplier);

            $address->setAddressType("$i");
            $address->setAddressCountry("France $i");
            $address->setAddressDistrict("Somme $i");
            $address->setAddressPostalCode("80000");
            $address->setAddressCity("Amiens $i");
            $address->setAddressNumStreet(rand(1, 100));
            $address->setAddressStreet("rue des cornichons $i");
            $address->setAddressComplement("Près du chapiteau !!! $i");

            $stock->setMaterial($material);
            $stock->setUnitPrice(rand(0, 100));
            $stock->setUnitStock(rand(0, 100));
            $stock->setUnitOnOrder(rand(0, 100));
            $stock->setDiscontinued(rand(0, 1));
            $stock->setFlag(rand(0, 1));

            $supplier->setAdress($address);
            $supplier->setSuppliCompanyName("Beuhnana n°$i");
            $supplier->setSuppliMail("Beuhnana$i@gmail.pom");
            $supplier->setSuppliPhone("666-666-6$i");
            $supplier->setPicture($picture);

            $manager->persist($material);
            $manager->persist($format);
            $manager->persist($stock);
            $manager->persist($picture);
            $manager->persist($address);
            $manager->persist($supplier);
            $manager->persist($product);
            $manager->persist($theme);




        }

        $manager->flush();
    }

}