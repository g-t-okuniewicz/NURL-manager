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
     * @ORM\Column(name="votes", type="integer")
     */
    private $votes;

    /**
     * @var \AppBundle\Entity\Nurl
     *
     * @ORM\ManyToOne(targetEntity="Nurl")
     * @ORM\JoinColumn(name="nurl_id", referencedColumnName="id")
     */
    private $nurl;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_candidate", type="boolean")
     */
    private $is_candidate;


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

    /**
     * Set isCandidate
     *
     * @param string $isCandidate
     *
     * @return Tag
     */
    public function setIsCandidate($is_candidate)
    {
        $this->is_candidate= $is_candidate;

        return $this;
    }

    /**
     * Get isCandidate
     *
     * @return string
     */
    public function getIsCandidate()
    {
        return $this->is_candidate;
    }

    /**
     * Set votes
     *
     * @param integer $votes
     *
     * @return Tag
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Get votes
     *
     * @return integer
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
