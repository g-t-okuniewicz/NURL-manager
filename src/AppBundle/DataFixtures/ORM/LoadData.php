<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Nurl;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadData implements FixtureInterface, ContainerAwareInterface
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
        // create users
        $userUser1 = $this->createActiveUser('user1', 'user1@user1.com', 'user1');
        $userUser2 = $this->createActiveUser('user2', 'user2@user2.com', 'user2');
        $userUser3 = $this->createActiveUser('user3', 'user3@user3.com', 'user3');
        $userAdmin = $this->createActiveUser('admin', 'admin@admin.com', 'admin', ['ROLE_ADMIN']);
        $userModerator = $this->createActiveUser('moderator', 'moderator@moderator.com', 'moderator', ['ROLE_MODERATOR']);

        // create nurls
        $nurl1 = $this->createNurl(
            $userUser1,
            new \DateTime(),
            'Google',
            'Quite popular search engine',
            'https://www.google.ie/',
            false,
            true,
            false
        );
        $nurl2 = $this->createNurl(
            $userUser2,
            new \DateTime(),
            'Yahoo',
            'Another search engine',
            'https://ie.yahoo.com/',
            false,
            true,
            false
        );
        $nurl3 = $this->createNurl(
            $userUser3,
            new \DateTime(),
            'Yandex',
            'Yet another search engine',
            'https://www.yandex.com/',
            false,
            true,
            false
        );
        $nurl4 = $this->createNurl(
            $userUser1,
            new \DateTime(),
            'Bing',
            "Microsoft's search engine",
            'https://www.bing.com/',
            true,
            true,
            false
        );
        $nurl5 = $this->createNurl(
            $userUser2,
            new \DateTime(),
            'Wikipedia',
            'Online encyclopedia',
            'https://en.wikipedia.org/wiki/Main_Page',
            false,
            true,
            true
        );
        $nurl6 = $this->createNurl(
            null,
            new \DateTime(),
            'MiniJuegos',
            'Flash games',
            'http://www.minijuegos.com/',
            false,
            false,
            false
        );



        // store to DB
        $manager->persist($userUser1);
        $manager->persist($userUser2);
        $manager->persist($userUser3);
        $manager->persist($userAdmin);
        $manager->persist($userModerator);
        $manager->persist($nurl1);
        $manager->persist($nurl2);
        $manager->persist($nurl3);
        $manager->persist($nurl4);
        $manager->persist($nurl5);
        $manager->persist($nurl6);
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

    private function createNurl($user, $created, $title, $summary, $content, $is_private, $is_published, $is_frozen)
    {
        $nurl = new Nurl();
        $nurl->setUser($user);
        $nurl->setCreated($created);
        $nurl->setTitle($title);
        $nurl->setSummary($summary);
        $nurl->setContent($content);
        $nurl->setIsPrivate($is_private);
        $nurl->setIsPublished($is_published);
        $nurl->setIsFrozen($is_frozen);

        return $nurl;
    }
}