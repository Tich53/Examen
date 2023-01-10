<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    const TAGS = [
        "Top reference"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TAGS as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
            $this->addReference($tagName, $tag);
        }
        $manager->flush();
    }
}
