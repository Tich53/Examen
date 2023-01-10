<?php

/* namespace App\DataFixtures;

use App\Entity\Competitor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetitorFixtures extends Fixture implements DependentFixtureInterface
{
    const COMPETITORS = [
        "oscaro",
        "piecesauto24",
        "mister-auto",
        "carpardoo",
        "piecesetpneus",
        "yakarouler"
    ];

    public function load(ObjectManager $manager): void
    {
        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[0]);
        $competitor->setWebsite("https://www.oscaro.com/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("0C", $competitor);

        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[1]);
        $competitor->setWebsite("https://www.piecesauto24.com/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("1C", $competitor);

        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[2]);
        $competitor->setWebsite("https://www.mister-auto.com/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("2C", $competitor);

        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[3]);
        $competitor->setWebsite("https://www.carpardoo.fr/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("3C", $competitor);

        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[4]);
        $competitor->setWebsite("https://www.piecesetpneus.com/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("4C", $competitor);

        $competitor = new Competitor();
        $competitor->setName(self::COMPETITORS[5]);
        $competitor->setWebsite("https://www.yakarouler.com/");
        $competitor->addWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($competitor);
        $this->addReference("5C", $competitor);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WebsiteFixtures::class,
        ];
    }
}
 */