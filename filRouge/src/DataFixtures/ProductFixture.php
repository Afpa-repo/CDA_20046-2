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
use App\Entity\Theme;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $stock = new Stock();
            $format = new Format();
            $material = new Material();
            $picture = new Picture();
            $role = new Role();
            $theme = new Theme();
            $address = new Address();
            $supplier = new Suppliers();
            $user = new User();

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

            $picture->setExtension("jpg");
            $picture->setLink("http://placeimg.com/640/360/any");

            $product->setStock($stock);
            $product->setProName("produit n°$i");
            $product->setProNote($i + 1);
            $product->setProLib("Libellé n°$i");
            $product->setProDescription("<h3>Description du produit n°$i</h3><p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, accusantium modi perspiciatis enim ex quos deleniti veniam quae laboriosam quia numquam placeat quo saepe officia qui repellendus corporis non excepturi.
                Delectus excepturi vel obcaecati corrupti ab dignissimos? Dicta soluta nihil dolorem, quia esse animi accusantium provident vero, sunt assumenda exercitationem doloribus vel illo fugiat voluptatibus eos! Minima maiores earum sapiente.
                Sit nobis odio similique quasi cupiditate architecto assumenda, aspernatur necessitatibus inventore corporis earum officiis perspiciatis excepturi non soluta neque illum beatae! Nulla, aperiam dolorem fugit impedit deleniti quod. Est, tempora!
                Veniam earum minus, nulla eligendi est magni quas delectus quibusdam exercitationem amet molestiae laudantium id iste ipsam neque commodi! Facere tempora, quod odit incidunt quo magnam totam aperiam dolor velit.
                Cum corporis odio aspernatur suscipit corrupti maxime! Voluptate recusandae vel, consequuntur similique accusantium quidem animi ratione quas repellat enim vitae numquam quisquam maxime sit officia est sed nemo, facere dolor!
            </p>");
            $product->setPicture($picture);

            $supplier->setAdress($address);
            $supplier->setSuppliCompanyName("Beuhnana n°$i");
            $supplier->setSuppliMail("Beuhnana$i@gmail.pom");
            $supplier->setSuppliPhone("666-666-6$i");
            $supplier->setPicture($picture);

            $user->setPicture($picture);
            $user->setAdress($address);
            $user->setUserLastName("Nom $i");
            $user->setUserFirstName("Prénom $i");
            $user->setUserPhone("999-999-9$i");
            $user->setUserBirthday(new \DateTime());
            $user->setUserGender("male Alpha");
            $user->setUserEmail("Beuhtatoss$i@gmail.pom");
            $user->setUserPassword(password_hash("motdepasse", PASSWORD_DEFAULT));

            $manager->persist($address);
            $manager->persist($role);
            $manager->persist($theme);
            $manager->persist($format);
            $manager->persist($material);
            $manager->persist($stock);
            $manager->persist($picture);
            $manager->persist($product);
            $manager->persist($supplier);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
