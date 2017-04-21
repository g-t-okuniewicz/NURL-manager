<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // create objects
        $userUser1 = $this->createActiveUser('user1', 'user1@user1.com', 'user1');
        $userUser2 = $this->createActiveUser('user2', 'user2@user2.com', 'user2');
        $userUser3 = $this->createActiveUser('user3', 'user3@user3.com', 'user3');
        $userAdmin = $this->createActiveUser('admin', 'admin@admin.com', 'admin', ['ROLE_ADMIN']);
        $userModerator = $this->createActiveUser('moderator', 'moderator@moderator.com', 'moderator', ['ROLE_MODERATOR']);

        // store to DB
        $manager->persist($userUser1);
        $manager->persist($userUser2);
        $manager->persist($userUser3);
        $manager->persist($userAdmin);
        $manager->persist($userModerator);
        $manager->flush();
    }

    private function createActiveUser($username, $email, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setIsActive(true);

        $encodedPassword = $this->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }

    private function encodePassword($user, $plainPassword):string
    {
        $encoder = $this->container->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}