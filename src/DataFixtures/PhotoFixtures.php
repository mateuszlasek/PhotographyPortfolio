<?php

// src/DataFixtures/PhotoFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Photo;

class PhotoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $imagesDirectory = __DIR__ . '/../../assets/images/';

        $files = scandir($imagesDirectory);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $photo = new Photo();
            $photo->setFileName($file);


            $manager->persist($photo);
        }

        $manager->flush();
    }
}
