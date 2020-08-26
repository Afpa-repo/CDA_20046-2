<?php


namespace App\DataFixtures;

use App\Entity\Format;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class e_FormatFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $format = new Format();

            $format->setFormatName("A$i");
            $manager->persist($format);
        }

        $manager->flush();
    }

}