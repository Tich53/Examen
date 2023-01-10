<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures /* extends Fixture */
{
    /*  const CATEGORIES = [ */
    /*         'Pièces moteur',
        'Filtres et huile',
        'Direction / Suspension / Train',
        'Freinage',
        'Démarrage électrique',
        'Optiques / Phares / Ampoules',
        'Embrayage et Boîte de vitesse',
        'Capteurs et Sondes',
        'Pièces Habitacle',
        'Echappement',
        'Essuie-glaces et pièces',
        'Carrosserie / Vitres / Peinture',
        'Accessoires et Equipements',
        'Joints et Étanchéité',
        'Chauffage et Climatisation',
        'Pneus et Equipements Roue',
        'Outillage',
        'Entretien et Nettoyage',
        'Attelage et Portage', */
    /*     ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference($categoryName, $category);
        }
        $manager->flush();
    } */
}
