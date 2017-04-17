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
        $userUser = $this->createActiveUser('user', 'user@user.com', 'user');
        $userAdmin = $this->createActiveUser('admin', 'admin@admin.com', 'admin');
        $userModerator = $this->createActiveUser('moderator', 'moderator@moderator.com', 'moderator');

        // store to DB
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userModerator);
        $manager->flush();
    }

    private function createActiveUser($username, $email, $plainPassword):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
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