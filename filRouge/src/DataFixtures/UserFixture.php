<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
       for($i = 0; $i<15;$i++){
           $user =(new user())
           ->setUserEmail("user$i@domain.fr")


           ->setUserFirstName("user$i")
           ->setUserLastName("user$i")
           ->setUserTitre("lorem")
           ->setUserGender("nonbinaire")
           ->setUserPhone("blablabla")
           ->setUserPassword("lorem") ;

       }
        $manager->flush();



    }

}