<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Website;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProductVoter extends Voter
{
    public const PRODUCT_EDIT = 'PRODUCT_EDIT';
    public const PRODUCT_VIEW = 'PRODUCT_VIEW';
    public const PRODUCT_DELETE = 'PRODUCT_DELETE';

    protected function supports(string $attribute, $product): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::PRODUCT_EDIT, self::PRODUCT_VIEW, self::PRODUCT_DELETE])
            && $product instanceof \App\Entity\Product;
    }

    protected function voteOnAttribute(string $attribute, $product, TokenInterface $token): bool
    {
        /** @var App\Entity\User */
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // Check if the product own to a website
        if (null === $product->getWebsite()) {
            return false;
        } else {
            $website = $product->getWebsite();
        }

        // Check if the website own to the user
        if (null === $website->getUsers()) return false;
        return ($website->getUsers()->contains($user) /* && $website === $product->getWebsite() */);
    }
}
