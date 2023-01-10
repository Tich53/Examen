<?php

namespace App\DataFixtures;

use App\Entity\Website;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class WebsiteFixtures extends Fixture
{
    const URLS = [
        "https://komparotoparts.com/",
        "https://www.oscaro.com"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::URLS as $URL) {
            $website = new Website();
            $website->setUrl($URL);
            $manager->persist($website);
            $this->addReference($URL, $website);
        }
        $manager->flush();
    }
}
