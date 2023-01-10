<?php
namespace App\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use App\Entity\ScrapingHistorical;
use App\Repository\CompetitorRepository;


class ScrapingHistoricalSubscriber implements EventSubscriberInterface
{

    public function __construct( CompetitorRepository $competitorRepository)
    {
        $this->competitorRepository = $competitorRepository;
    }
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
        );
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->addCompetitor($args);
    }

    public function addCompetitor(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        
        if ($entity instanceof ScrapingHistorical) {
            $name=$entity->getName();
            $entity->setCompetitor($this->competitorRepository->findOneByName($name));
          
            return $entity;
        }
    }

}

