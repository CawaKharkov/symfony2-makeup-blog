<?php

namespace AppBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class NamedEntity
 * @package AppBundle\Entity\Traits
 */
trait NamedEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min="3")
     */
    protected $name;


    /**
     * Set name
     *
     * @param string $name
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}