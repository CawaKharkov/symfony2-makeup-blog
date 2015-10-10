<?php

namespace AppBundle\Entity\Traits;


/**
 * Class IdentificationalEntity
 * @package AppBundle\Entity\Traits
 */
trait IdentificationalEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    protected  $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}