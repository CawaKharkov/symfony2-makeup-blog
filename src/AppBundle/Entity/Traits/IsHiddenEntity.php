<?php

namespace AppBundle\Entity\Traits;


/**
 * Class IsActiveEntity
 * @package AppBundle\Entity\Traits
 */
trait IsHiddenEntity
{
    /**
     * @var integer
     * @ORM\Column(name="isHidden", type="boolean")
     */
    protected $isHidden = null;

    /**
     * @return int
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * @param int $isHidden
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
    }


}