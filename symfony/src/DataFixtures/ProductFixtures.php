<?php

/* namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    { */
/*         $product = new Product();
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[1]));
        $product->setCleanedBrand("3F QUALITY");
        $product->setRawBrand("3F QUALITY");
        $product->setCleanedReference("548");
        $product->setRawReference("548");
        $product->setImage("https://pubimg.4mycar.ru/images/full/00684e9780df01442162edf20d4b29ffc0a1ae0002.jpeg");
        $product->setName("Filtre, air de l'habitacle");
        $product->setPrice(1);
        $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-548");
        $product->setWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $product->addTag($this->getReference(TagFixtures::TAGS[0]));
        $manager->persist($product);
        $this->addReference(1, $product);

        $product = new Product();
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[1]));
        $product->setCleanedBrand("3F QUALITY");
        $product->setRawBrand("3F QUALITY");
        $product->setCleanedReference("569");
        $product->setRawReference("569");
        $product->setImage("https://pieces-auto.market/images/3FQUALITY/1569/1569.jpg");
        $product->setName("Filtre, air de l'habitacle");
        $product->setPrice(1);
        $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-569");
        $product->setWebsite($this->getReference(WebsiteFixtures::URLS[1]));
        $manager->persist($product);
        $this->addReference(2, $product);

        $product = new Product();
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[1]));
        $product->setCleanedBrand("3F QUALITY");
        $product->setRawBrand("3F QUALITY");
        $product->setCleanedReference("572");
        $product->setRawReference("572");
        $product->setImage("https://autocode.ru/pic/250/mercedes/A1698300218.jpeg");
        $product->setName("Filtre, air de l'habitacle");
        $product->setPrice(1);
        $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-572");
        $product->setWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $manager->persist($product);
        $this->addReference(3, $product);

        $product = new Product();
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[1]));
        $product->setCleanedBrand("3F QUALITY");
        $product->setRawBrand("3F QUALITY");
        $product->setCleanedReference("677");
        $product->setRawReference("677");
        $product->setImage("https://aftermarket.7zap.com/img/228/02280012701255.jpg");
        $product->setName("Filtre, air de l'habitacle");
        $product->setPrice(1);
        $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-677");
        $product->setWebsite($this->getReference(WebsiteFixtures::URLS[1]));
        $manager->persist($product);
        $this->addReference(4, $product);

        $product = new Product();
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[1]));
        $product->setCleanedBrand("3F QUALITY");
        $product->setRawBrand("3F QUALITY");
        $product->setCleanedReference("687");
        $product->setRawReference("687");
        $product->setImage("https://pieces-auto.market/images/FEBIBILSTEIN/100381/100381.jpg");
        $product->setName("Filtre, air de l'habitacle");
        $product->setPrice(1);
        $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-687");
        $product->setWebsite($this->getReference(WebsiteFixtures::URLS[0]));
        $product->addTag($this->getReference(TagFixtures::TAGS[0]));
        $manager->persist($product);
        $this->addReference(5, $product);

        for ($i = 6; $i <= 500; $i++) {
            $ref = rand(1, 999);
            $product = new Product();
            $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[rand(0, 18)]));
            $product->setCleanedBrand("3F QUALITY");
            $product->setRawBrand("3F QUALITY");
            $product->setCleanedReference($ref);
            $product->setRawReference($ref);
            $product->setImage("https://pieces-auto.market/images/FEBIBILSTEIN/100381/100381.jpg");
            $product->setName("Filtre, air de l'habitacle");
            $product->setPrice(1);
            $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-687");
            $product->setWebsite($this->getReference(WebsiteFixtures::URLS[rand(0, 1)]));
            $manager->persist($product);
            $this->addReference($i, $product);
        }
        for ($i = 501; $i <= 550; $i++) {
            $ref = rand(1, 999);
            $product = new Product();
            $product->setCategory($this->getReference(CategoryFixtures::CATEGORIES[rand(0, 18)]));
            $product->setCleanedBrand("4f");
            $product->setRawBrand("Ultra///BrIcE");
            $product->setCleanedReference($ref);
            $product->setRawReference($ref);
            $product->setImage("https://pieces-auto.market/images/FEBIBILSTEIN/100381/100381.jpg");
            $product->setName("pneu");
            $product->setPrice(1);
            $product->setUrl("https://komparotoparts.com/pieces-auto/p/filtre-air-de-lhabitacle-3f-quality-687");
            $product->setWebsite($this->getReference(WebsiteFixtures::URLS[rand(0, 1)]));
            $manager->persist($product);
            $this->addReference($i, $product);
        }

        $manager->flush(); */
/*     }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            WebsiteFixtures::class,
            TagFixtures::class,
        ];
    }
} */
