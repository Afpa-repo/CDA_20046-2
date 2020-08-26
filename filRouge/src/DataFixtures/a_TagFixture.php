<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class a_TagFixture extends Fixture {

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++){
            $tag = new Tag();

            $tag->setName("tag n°$i");

            $manager->persist($tag);
        }

        $manager->flush();
    }

}