<?php


namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class d_RoleFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $role = new Role();

            $role->setRole("role n°$i");
            $manager->persist($role);
        }

        $manager->flush();
    }

}