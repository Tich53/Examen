<?php
namespace App\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use App\Entity\CompetitorProduct;
use App\Entity\CompetitorProductPriceHistorical;
use App\Repository\CompetitorProductRepository;
use App\Repository\CompetitorRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CompetitorProductSubscriber implements EventSubscriberInterface
{

    public function __construct(private ProductRepository $productRepository, private CompetitorRepository $competitorRepository)
    {
        $this->productRepository = $productRepository;
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
        $this->cleanData($args);
        $this->setCompetitorAndMatch($args);
       
    }
    
    public function cleanData(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        
        if ($entity instanceof CompetitorProduct) {
            
            $entity->setCleanedReference(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($entity->getRawReference())));
            $entity->setCleanedBrand(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($entity->getRawBrand())));
            return $entity;
        }
    }

    public function setCompetitorAndMatch(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof CompetitorProduct) {
          
            $host = parse_url($entity->getUrl(), PHP_URL_HOST); 
            $name = explode(".",str_ireplace("www.","",$host))[0];
            $entity->setCompetitor($this->competitorRepository->findOneByName($name));
            $entity->setProduct($this->productRepository->findOneByCleanedBrandAndReference($entity->getCleanedBrand(), $entity->getCleanedReference()));
          
            return $entity;
        }
    }

}








