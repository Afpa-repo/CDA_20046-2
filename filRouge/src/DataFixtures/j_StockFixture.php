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


            $stock->setFormat($format);
            $format->setFormatName("A$i");

            $material->setMaterialName("Matos n°$i");

            $stock->setMaterial($material);
            $stock->setUnitPrice(rand(0, 100));
            $stock->setUnitStock(rand(0, 100));
            $stock->setUnitOnOrder(rand(0, 100));
            $stock->setDiscontinued(rand(0, 1));
            $stock->setFlag(rand(0, 1));


        }

        $manager->flush();
    }

}