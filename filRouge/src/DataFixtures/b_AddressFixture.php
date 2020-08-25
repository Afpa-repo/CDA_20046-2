<?php


namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class b_AddressFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 25; $i++) {
            $address = new Address();

            $address->setAddressType("$i");
            $address->setAddressCountry("France $i");
            $address->setAddressDistrict("Somme $i");
            $address->setAddressPostalCode("80000");
            $address->setAddressCity("Amiens $i");
            $address->setAddressNumStreet(rand(1, 100));
            $address->setAddressStreet("rue des cornichons $i");
            $address->setAddressComplement("Près du chapiteau !!! $i");

            $manager->persist($address);
        }

        $manager->flush();
    }

}