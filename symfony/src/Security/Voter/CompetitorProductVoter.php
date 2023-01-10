<?php

namespace App\Security\Voter;

use App\Entity\CompetitorProduct;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CompetitorProductVoter extends Voter
{
    public const COMPETITOR_PRODUCT_VIEW = 'COMPETITOR_PRODUCT_VIEW';

    protected function supports(string $attribute, $competitor_product): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::COMPETITOR_PRODUCT_VIEW])
            && $competitor_product instanceof CompetitorProduct;
    }

    protected function voteOnAttribute(string $attribute, $competitor_product, TokenInterface $token): bool
    {
        /** @var ?User $user */
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        // Vérifie que le produit est associé à un concurrent
        if (null === $competitor_product->getCompetitor()) {
            return false;
        } else {
            $competitor = $competitor_product->getCompetitor();
        }
        // Vérifie que le concurrent est bien le concurrent de l'utilisateur connecté
        return ($competitor->getWebsites()->contains($user->getWebsite()));
    }
}
