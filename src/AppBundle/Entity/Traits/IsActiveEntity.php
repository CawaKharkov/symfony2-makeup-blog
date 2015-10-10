<?php

namespace AppBundle\Entity\Traits;


/**
 * Class IsActiveEntity
 * @package AppBundle\Entity\Traits
 */
trait IsActiveEntity
{
    /**
     * @var integer
     * @ORM\Column(name="isActive", type="boolean")
     */
    protected $isActive = null;

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param int $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }


}