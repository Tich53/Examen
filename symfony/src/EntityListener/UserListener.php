<?php

namespace App\EntityListener;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;


class UserListener
{

    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $encoder
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /** @Orm\PrePersist */
    public function prePersist(User $user, LifecycleEventArgs $args)
    {
        $password = $user->getPassword();
        $password = $this->encodePassword($user, $password);
        $user->setPassword($password);
    }

    /** @Orm\PreUpdate */
    public function preUpdate(User $user, PreUpdateEventArgs $args)
    {
        if ($args->hasChangedField('password')) {
            $password = $args->getNewValue('password');
            $password = $this->encodePassword($user, $password);
            $user->setPassword($password);
        }
    }

    public function encodePassword(User $user, string $password)
    {
        return $this->hasher->hashPassword($user, $password);
    }
}
