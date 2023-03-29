<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 3 users
        // Super admin user
        // Admin user
        // User user

        $sup = new User();
        $sup->setEmail('superadmin@icewize.fr');
        $sup->setRoles(['ROLE_SUPER_ADMIN']);
        $sup->setPassword('$2y$13$giejzi1w6nIZKbdODaXDNugQjJfDJrHcKv9dIqDje7DdVPN4Q9CSa');
        $sup->setUsername('superadmin');
        $sup->setTermAccepted(true);
        $sup->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($sup);

        $admin = new User();
        $admin->setEmail('admin@icewize.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$giejzi1w6nIZKbdODaXDNugQjJfDJrHcKv9dIqDje7DdVPN4Q9CSa');
        $admin->setUsername('admin');
        $admin->setTermAccepted(true);
        $admin->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@icewize.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$2y$13$giejzi1w6nIZKbdODaXDNugQjJfDJrHcKv9dIqDje7DdVPN4Q9CSa');
        $user->setUsername('user');
        $user->setTermAccepted(true);
        $user->setEmailVerifiedAt(new \DateTimeImmutable());
        $manager->persist($user);

        $manager->flush();
    }
}
