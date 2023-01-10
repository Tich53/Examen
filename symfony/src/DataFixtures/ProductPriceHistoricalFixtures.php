<?php
/* 
namespace App\DataFixtures;

use App\Entity\ProductPriceHistorical;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductPriceHistoricalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    { */
/*         $productPriceHistorical = new ProductPriceHistorical();
        $productPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $productPriceHistorical->setPrice(1);
        $productPriceHistorical->setProduct($this->getReference(1));
        $manager->persist($productPriceHistorical);

        $productPriceHistorical = new ProductPriceHistorical();
        $productPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $productPriceHistorical->setPrice(1);
        $productPriceHistorical->setProduct($this->getReference(2));
        $manager->persist($productPriceHistorical);

        $productPriceHistorical = new ProductPriceHistorical();
        $productPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $productPriceHistorical->setPrice(1);
        $productPriceHistorical->setProduct($this->getReference(3));
        $manager->persist($productPriceHistorical);

        $productPriceHistorical = new ProductPriceHistorical();
        $productPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $productPriceHistorical->setPrice(1);
        $productPriceHistorical->setProduct($this->getReference(4));
        $manager->persist($productPriceHistorical);

        $productPriceHistorical = new ProductPriceHistorical();
        $productPriceHistorical->setCreatedAt(date_create("2022-09-29"));
        $productPriceHistorical->setPrice(1);
        $productPriceHistorical->setProduct($this->getReference(5));
        $manager->persist($productPriceHistorical);

        for ($i = 6; $i <= 500; $i++) {
            $productPriceHistorical = new ProductPriceHistorical();
            $productPriceHistorical->setCreatedAt(date_create("2022-10-09"));
            $productPriceHistorical->setPrice(1);
            $productPriceHistorical->setProduct($this->getReference($i));
            $manager->persist($productPriceHistorical);
        }

        $manager->flush(); */
/*     }

    function getDependencies()
    {
        return [
            ProductFixtures::class
        ];
    }
}
 */