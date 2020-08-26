<?php


namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class c_ThemeFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $theme = new Theme();

            $theme->setThemeName("Thème n°$i");
            $manager->persist($theme);
        }

        $manager->flush();
    }

}