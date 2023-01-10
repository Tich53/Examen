<?php

/* namespace App\DataFixtures;

use App\Entity\CompetitorProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetitorProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const BRANDS = [
        "HERTH+BUSS JAKOPARTS",
        "MECAFILTER",
        "3F QUALITY",
        "NIPPON PIECES SERVICES"
    ];

    public function load(ObjectManager $manager): void
    { */
/*         $product_competitor = new CompetitorProduct();
        $product_competitor->setProduct(null);
        $product_competitor->setCompetitor($this->getReference("0C"));
        $product_competitor->setPrice(9.5);
        $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
        $product_competitor->setRawName("Filtre d'habitacle");
        $product_competitor->setCleanedName("Filtre d'habitacle");
        $product_competitor->setRawReference("J1348013");
        $product_competitor->setCleanedReference("J1348013");
        $product_competitor->setRawBrand(self::BRANDS[0]);
        $product_competitor->setCleanedBrand(self::BRANDS[0]);
        $product_competitor->setIsInStock(true);
        $this->addReference("1CP", $product_competitor);
        $manager->persist($product_competitor);

        $product_competitor = new CompetitorProduct();
        $product_competitor->setProduct(null);
        $product_competitor->setCompetitor($this->getReference("1C"));
        $product_competitor->setPrice(21.8);
        $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
        $product_competitor->setRawName("Filtre d'habitacle");
        $product_competitor->setCleanedName("Filtre d'habitacle");
        $product_competitor->setRawReference("548");
        $product_competitor->setCleanedReference("548");
        $product_competitor->setRawBrand(self::BRANDS[1]);
        $product_competitor->setCleanedBrand(self::BRANDS[1]);
        $product_competitor->setIsInStock(false);
        $this->addReference("2CP", $product_competitor);
        $manager->persist($product_competitor);

        $product_competitor = new CompetitorProduct();
        $product_competitor->setProduct(null);
        $product_competitor->setCompetitor($this->getReference("2C"));
        $product_competitor->setPrice(9.5);
        $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
        $product_competitor->setRawName("Filtre d'habitacle");
        $product_competitor->setCleanedName("Filtre d'habitacle");
        $product_competitor->setRawReference("572");
        $product_competitor->setCleanedReference("572");
        $product_competitor->setRawBrand(self::BRANDS[2]);
        $product_competitor->setCleanedBrand(self::BRANDS[2]);
        $product_competitor->setIsInStock(true);
        $this->addReference("3CP", $product_competitor);
        $manager->persist($product_competitor);

        $product_competitor = new CompetitorProduct();
        $product_competitor->setProduct(null);
        $product_competitor->setCompetitor($this->getReference("3C"));
        $product_competitor->setPrice(18.5);
        $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
        $product_competitor->setRawName("Filtre d'habitacle");
        $product_competitor->setCleanedName("Filtre d'habitacle");
        $product_competitor->setRawReference("M135A06");
        $product_competitor->setCleanedReference("M135A06");
        $product_competitor->setRawBrand(self::BRANDS[3]);
        $product_competitor->setCleanedBrand(self::BRANDS[3]);
        $product_competitor->setIsInStock(true);
        $this->addReference("4CP", $product_competitor);
        $manager->persist($product_competitor);

        $product_competitor = new CompetitorProduct();
        $product_competitor->setProduct(null);
        $product_competitor->setCompetitor($this->getReference("4C"));
        $product_competitor->setPrice(10.2);
        $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
        $product_competitor->setRawName("Filtre d'habitacle");
        $product_competitor->setCleanedName("Filtre d'habitacle");
        $product_competitor->setRawReference("ADH22511");
        $product_competitor->setCleanedReference("ADH22511");
        $product_competitor->setRawBrand(self::BRANDS[2]);
        $product_competitor->setCleanedBrand(self::BRANDS[2]);
        $product_competitor->setIsInStock(true);
        $this->addReference("5CP", $product_competitor);
        $manager->persist($product_competitor);

        for ($i = 6; $i <= 500; $i++) {
            $ref = rand(1, 9999);
            $brand = rand(0, 3);
            $product_competitor = new CompetitorProduct();
            $product_competitor->setProduct(null);
            $product_competitor->setCompetitor($this->getReference(rand(0, 5) . "C"));
            $product_competitor->setPrice(10);
            $product_competitor->setUrl("https://www.oscaro.com/filtre-dhabitacle-quinton-hazell-qfc0427-11766158-424-p");
            $product_competitor->setRawName("Filtre d'habitacle");
            $product_competitor->setCleanedName("Filtre d'habitacle");
            $product_competitor->setRawReference($ref);
            $product_competitor->setCleanedReference($ref);
            $product_competitor->setRawBrand(self::BRANDS[$brand]);
            $product_competitor->setCleanedBrand(self::BRANDS[$brand]);
            $product_competitor->setIsInStock(true);
            $this->addReference($i . "CP", $product_competitor);
            $manager->persist($product_competitor);
        }

        $manager->flush(); */
/*     }

    public function getDependencies()
    {
        return [
            CompetitorFixtures::class,
        ];
    }
}
 */