<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SharedCollection
 *
 * @ORM\Table(name="shared_collection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SharedCollectionRepository")
 */
class SharedCollection
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
     * @var \AppBundle\Entity\Collection
     *
     * @ORM\ManyToOne(targetEntity="Collection")
     * @ORM\JoinColumn(name="collection_id", referencedColumnName="id")
     */
    private $collection;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="shared_by", referencedColumnName="id")
     */
    private $shared_by;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="shared_with", referencedColumnName="id")
     */
    private $shared_with;


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
     * Set collection
     *
     * @param \AppBundle\Entity\Collection $collection
     *
     * @return SharedCollection
     */
    public function setCollection(\AppBundle\Entity\Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return \AppBundle\Entity\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set sharedBy
     *
     * @param \AppBundle\Entity\User $sharedBy
     *
     * @return SharedCollection
     */
    public function setSharedBy(\AppBundle\Entity\User $sharedBy)
    {
        $this->shared_by = $sharedBy;

        return $this;
    }

    /**
     * Get sharedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getSharedBy()
    {
        return $this->shared_by;
    }

    /**
     * Set sharedWith
     *
     * @param \AppBundle\Entity\User $sharedWith
     *
     * @return SharedCollection
     */
    public function setSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->shared_with = $sharedWith;

        return $this;
    }

    /**
     * Get sharedWith
     *
     * @return \AppBundle\Entity\User
     */
    public function getSharedWith()
    {
        return $this->shared_with;
    }
}
