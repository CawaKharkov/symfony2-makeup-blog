<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\Menu\NodeInterface;
use AppBundle\Entity\Traits\IdentificationalEntity;
use AppBundle\Entity\Traits\IsActiveEntity;
use AppBundle\Entity\Traits\IsHiddenEntity;

// gedmo annotations

/**
 * Link
 *
 * @ORM\Table(name="links")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\LinkRepository")
 */
class Link implements NodeInterface
{

    use IdentificationalEntity;
    use IsHiddenEntity;

    protected static $types = [3 => 'MENU_LINK']; //0 => 'MAIN_MENU', 1 => 'SUB_MENU', 2 => 'SUB_MENU_CHILD',

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint",nullable=true)
     */
    protected $type = 3;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255)
     */
    protected $route = '/';

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=64)
     */
    protected $title;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer",nullable=true)
     */
    protected $position;

    /**
     * Set type
     *
     * @param integer $type
     * @return Navigation
     */
    public function setType($type)
    {
        if (!in_array($type, self::$types)) {
            throw new InvalidArgumentException('There\'s no such type of navigation - ' . $type);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public static function getTypeList()
    {
        return self::$types;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Navigation
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Navigation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getChildren()
    {
        return null;
    }

    public function getName()
    {
        return $this->title;
    }

    public function getOptions()
    {
        return ['uri' => $this->route];
    }

}
