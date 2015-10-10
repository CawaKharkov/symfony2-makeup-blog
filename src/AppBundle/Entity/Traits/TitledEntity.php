<?php

namespace AppBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints\NotBlank;


/**
 * Class TitledEntity
 * @package AppBundle\Entity\Traits
 */
trait TitledEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @NotBlank()
     */
    protected $title;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


}