<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="upvotes", type="integer")
     */
    private $upvotes;

    /**
     * @var int
     *
     * @ORM\Column(name="downvotes", type="integer")
     */
    private $downvotes;

    /**
     * @var \AppBundle\Entity\Nurl
     *
     * @ORM\ManyToOne(targetEntity="Nurl")
     * @ORM\JoinColumn(name="nurl_id", referencedColumnName="id")
     */
    private $nurl;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Tag
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content=string(255)
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set upvotes
     *
     * @param integer $upvotes
     *
     * @return Tag
     */
    public function setUpvotes($upvotes)
    {
        $this->upvotes = $upvotes;

        return $this;
    }

    /**
     * Get upvotes
     *
     * @return int
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Set downvotes
     *
     * @param integer $downvotes
     *
     * @return Tag
     */
    public function setDownvotes($downvotes)
    {
        $this->downvotes = $downvotes;

        return $this;
    }

    /**
     * Get downvotes
     *
     * @return int
     */
    public function getDownvotes()
    {
        return $this->downvotes;
    }

    /**
     * Set nurl
     *
     * @param \AppBundle\Entity\Nurl $nurl
     *
     * @return Tag
     */
    public function setNurl(\AppBundle\Entity\Nurl $nurl)
    {
        $this->nurl = $nurl;

        return $this;
    }

    /**
     * Get nurl
     *
     * @return \AppBundle\Entity\Nurl
     */
    public function getNurl()
    {
        return $this->nurl;
    }
}
