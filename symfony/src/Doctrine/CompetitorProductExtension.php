<?php

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use Symfony\Component\Security\Core\Security;


use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use App\Entity\CompetitorProduct;


final class CompetitorProductExtension implements QueryCollectionExtensionInterface
{

    /**
     * @param Security $security
     */
    public function __construct(private Security $security)
    {
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {

        $this->addWhere($queryBuilder, $resourceClass);
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     *
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {

        /** @var ?User $user */
        $user = $this->security->getUser();

        if (

            CompetitorProduct::class !== $resourceClass
            || $this->security->isGranted('ROLE_ADMIN')
            || null === $user
        ) {
            return;
        }


        /** @var ?Website $website */
        $userWebsite = $user->getWebsite();

        $userCompetitors = $userWebsite->getCompetitor();

        $competitorIds = [];
        foreach ($userCompetitors as $competitor) {
            $competitorIds[] = $competitor->getId();
        }


        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere("$rootAlias.competitor IN (" . implode(',', $competitorIds) . ")");
    }
}
