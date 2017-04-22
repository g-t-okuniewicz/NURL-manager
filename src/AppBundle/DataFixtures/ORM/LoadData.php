<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Nurl;
use AppBundle\Entity\Tag;
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
            new \DateTime('12-01-2017 21:15:36'),
            'Google',
            'Quite popular search engine',
            'https://www.google.ie/',
            false,
            true,
            false
        );
        $nurl2 = $this->createNurl(
            $userUser2,
            new \DateTime('14-01-2017 12:47:55'),
            'Yahoo',
            'Another search engine',
            'https://ie.yahoo.com/',
            false,
            true,
            false
        );
        $nurl3 = $this->createNurl(
            $userUser3,
            new \DateTime('04-02-2017 08:17:18'),
            'Yandex',
            'Yet another search engine',
            'https://www.yandex.com/',
            false,
            true,
            false
        );;
        $nurl4 = $this->createNurl(
            $userUser1,
            new \DateTime('13-02-2017 20:30:11'),
            'Bing',
            "Microsoft's search engine",
            'https://www.bing.com/',
            true,
            true,
            false
        );
        $nurl5 = $this->createNurl(
            $userUser2,
            new \DateTime('14-02-2017 16:51:23'),
            'Wikipedia',
            'Online encyclopedia',
            'https://en.wikipedia.org/wiki/Main_Page',
            false,
            true,
            true
        );
        $nurl6 = $this->createNurl(
            null,
            new \DateTime('11-03-2017 19:01:03'),
            'MiniJuegos',
            'Flash games',
            'http://www.minijuegos.com/',
            false,
            false,
            false
        );

        //create tags
        $tag1 = $this->createTag(
            'search engine',
            $nurl1,
            false
        );
        $tag2 = $this->createTag(
            'useful',
            $nurl1,
            false
        );
        $tag3 = $this->createTag(
            'life-saver',
            $nurl1,
            true
        );
        $tag4 = $this->createTag(
            'search engine',
            $nurl2,
            false
        );
        $tag5 = $this->createTag(
            'not google',
            $nurl2,
            false
        );
        $tag6 = $this->createTag(
            'candidate tag',
            $nurl2,
            true
        );
        $tag7 = $this->createTag(
            'search engine',
            $nurl3,
            false
        );
        $tag8 = $this->createTag(
            'alternative',
            $nurl3,
            false
        );
        $tag9 = $this->createTag(
            'Russian',
            $nurl3,
            true
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
        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($tag3);
        $manager->persist($tag4);
        $manager->persist($tag5);
        $manager->persist($tag6);
        $manager->persist($tag7);
        $manager->persist($tag8);
        $manager->persist($tag9);
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

    private function createTag($content, $nurl, $is_candidate)
    {
        $tag = new Tag();
        $tag->setContent($content);
        $tag->setNurl($nurl);
        $tag->setIsCandidate($is_candidate);
        $tag->setVotes(0);

        return $tag;
    }
}