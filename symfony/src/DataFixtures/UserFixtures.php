<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    const USER_EMAIL_ADMIN = "admin@donkey.school";
    const USER_EMAIL_USER = "user@donkey.school";
    const USER_EMAIL_SCRAPER = "scraper@donkey.school";

    const ROLE_ADMIN = "Role admin";
    const ROLE_USER = "Role user";

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail(self::USER_EMAIL_ADMIN);
        $user->setPassword('0123');
        $user->setRoles([
            'ROLE_ADMIN',
        ]);
        $manager->persist($user);

        $user = new User();
        $user->setEmail(self::USER_EMAIL_USER);
        $user->setPassword('0123');
        $user->setRoles([
            'ROLE_USER',
        ]);
        $user->setWebsite($this->getReference(WebsiteFixtures::URLS[0]));

        $manager->persist($user);

        $user = new User();
        $user->setEmail(self::USER_EMAIL_SCRAPER);
        $user->setPassword('0123');
        $user->setRoles([
            'ROLE_ADMIN',
        ]);
        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            WebsiteFixtures::class
        ];
    }
}
