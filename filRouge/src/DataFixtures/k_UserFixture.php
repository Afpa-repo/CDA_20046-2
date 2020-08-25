<?php


namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class k_UserFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $role = new Role();
            $address = new Address();


            $user->setRole($role);
            $user->setAdress($address);

            $role->setRole("role n°$i");

            $address->setAddressType("$i");
            $address->setAddressCountry("France $i");
            $address->setAddressDistrict("Somme $i");
            $address->setAddressPostalCode("80000");
            $address->setAddressCity("Amiens $i");
            $address->setAddressNumStreet(rand(1, 100));
            $address->setAddressStreet("rue des cornichons $i");
            $address->setAddressComplement("Près du chapiteau !!! $i");

            $user->setUserLastName("Nom $i");
            $user->setUserFirstName("Prénom $i");
            $user->setUserPhone("999-999-9$i");
            $user->setUserBirthday(new \DateTime());
            $user->setUserGender("male Alpha");
            $user->setUserEmail("Beuhtatoss$i@gmail.pom");
            $user->setUserPassword(password_hash("motdepasse", PASSWORD_DEFAULT));
            $user->setImageName('https://picsum.photos/297/300');
            $user->setImageSize(1);
            $user->setUpdatedAt(new \DateTime);

            $manager->persist($role);
            $manager->persist($address);
            $manager->persist($user);

        }

        $manager->flush();
    }

}