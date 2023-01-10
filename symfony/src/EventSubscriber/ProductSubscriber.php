<?php

namespace App\EventSubscriber;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use App\Entity\Product;

class ProductSubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->cleanData($args);
    }
    
    private function cleanData(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Product) {
            $entity->setCleanedReference(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($entity->getRawReference())));
            $entity->setCleanedBrand(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($entity->getRawBrand())));
            return $entity;
        }
    }
}