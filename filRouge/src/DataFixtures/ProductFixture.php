<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Format;
use App\Entity\Material;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Role;
use App\Entity\Stock;
use App\Entity\Suppliers;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
            $stock = new Stock();
            $format = new Format();
            $material = new Material();
            $image = new Picture();
            $role = new Role();
            $theme = new Theme();
            $address = new Address();
            $supplier = new Suppliers();
            $user = new User();
            $tag = new Tag();

            $tag->setName("tag n°$i");

            $address->setAddressType("$i");
            $address->setAddressCountry("France $i");
            $address->setAddressDistrict("Somme $i");
            $address->setAddressPostalCode("80000");
            $address->setAddressCity("Amiens $i");
            $address->setAddressNumStreet(rand(1, 100));
            $address->setAddressStreet("rue des cornichons $i");
            $address->setAddressComplement("Près du chapiteau !!! $i");

            $theme->setThemeName("Thème n°$i");

            $role->setRole("role n°$i");

            $format->setFormatName("A$i");

            $material->setMaterialName("Matos n°$i");

            $stock->setFormat($format);
            $stock->setMaterial($material);
            $stock->setUnitPrice(rand(0, 100));
            $stock->setUnitStock(rand(0, 100));
            $stock->setUnitOnOrder(rand(0, 100));
            $stock->setDiscontinued(rand(0, 1));
            $stock->setFlag(rand(0, 1));

            $image->setExtension("jpg");
            $image->setLink("http://placeimg.com/640/360/any");
            $image->setImage("$i.jpg");
            $image->setupdatedAt(new \DateTime());

            $product->setProName("produit n°$i");
            $product->setProNote($i + 1);
            $product->setProLib("Libellé n°$i");
            $product->setProDescription("<h3>Description du produit n°$i</h3><p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </p>");
            $product->setPicture($image);
            $product->setTheme($theme);


            $supplier->setAdress($address);
            $supplier->setSuppliCompanyName("Beuhnana n°$i");
            $supplier->setSuppliMail("Beuhnana$i@gmail.pom");
            $supplier->setSuppliPhone("666-666-6$i");
            $supplier->setPicture($image);

            $material->setSupplier($supplier);

            $user->setPicture($image);
            $user->setRole($role);
            $user->setAdress($address);
            $user->setUserLastName("Nom $i");
            $user->setUserFirstName("Prénom $i");
            $user->setUserPhone("999-999-9$i");
            $user->setUserBirthday(new \DateTime());
            $user->setUserGender("male Alpha");
            $user->setUserEmail("Beuhtatoss$i@gmail.pom");
            $user->setUserPassword(password_hash("motdepasse", PASSWORD_DEFAULT));

            $manager->persist($tag);
            $manager->persist($address);
            $manager->persist($role);
            $manager->persist($theme);
            $manager->persist($format);
            $manager->persist($material);
            $manager->persist($stock);
            $manager->persist($image);
            $manager->persist($product);
            $manager->persist($supplier);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
