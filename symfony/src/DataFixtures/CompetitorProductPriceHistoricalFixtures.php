<?php

/* namespace App\DataFixtures;

use App\Entity\CompetitorProductPriceHistorical;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetitorProductPriceHistoricalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    { */
/*         $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
        $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $competitorProductPriceHistorical->setPrice(9.5);
        $competitorProductPriceHistorical->setProductCompetitor($this->getReference("1CP"));
        $manager->persist($competitorProductPriceHistorical);

        $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
        $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $competitorProductPriceHistorical->setPrice(21.8);
        $competitorProductPriceHistorical->setProductCompetitor($this->getReference("2CP"));
        $manager->persist($competitorProductPriceHistorical);

        $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
        $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $competitorProductPriceHistorical->setPrice(9.5);
        $competitorProductPriceHistorical->setProductCompetitor($this->getReference("3CP"));
        $manager->persist($competitorProductPriceHistorical);

        $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
        $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $competitorProductPriceHistorical->setPrice(18.5);
        $competitorProductPriceHistorical->setProductCompetitor($this->getReference("4CP"));
        $manager->persist($competitorProductPriceHistorical);

        $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
        $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $competitorProductPriceHistorical->setPrice(10.2);
        $competitorProductPriceHistorical->setProductCompetitor($this->getReference("5CP"));
        $manager->persist($competitorProductPriceHistorical);

        for ($i = 6; $i <= 500; $i++) {
            $competitorProductPriceHistorical = new CompetitorProductPriceHistorical();
            $competitorProductPriceHistorical->setCreatedAt(date_create("2022-09-29"));
            $competitorProductPriceHistorical->setPrice(10);
            $competitorProductPriceHistorical->setProductCompetitor($this->getReference($i . "CP"));
            $manager->persist($competitorProductPriceHistorical);
        }

        $manager->flush(); */
/*     }

    public function getDependencies()
    {
        return [
            CompetitorProductFixtures::class,
        ];
    }
}
 */