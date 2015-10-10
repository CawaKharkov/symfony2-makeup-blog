<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Traits\IdentificationalEntity;
use AppBundle\Entity\Traits\NamedEntity;


// gedmo annotations

/**
 * Menu
 *
 * @ORM\Table(name="menus", indexes={
 * @ORM\Index(name="tree_idx", columns={"rgt", "lft","root"}),
 * @ORM\Index(name="lft_idx", columns={"lft"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MenuRepository")
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 */
class Menu
{
    use IdentificationalEntity;
    //use NamedEntity;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min="3")
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint")
     */
    protected $type = 0;
    protected static $types = [0 => 'MAIN_MENU', 1 => 'SUB_MENU', 2 => 'SUB_MENU_CHILD'];

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint")
     */
    protected $position = 4;
    protected static $positions = [0 => 'TOP', 1 => 'LEFT', 2 => 'RIGHT', 3 => 'FOOT',
        4 => 'DEFAULT'];


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Link",
     * cascade={"persist"},fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $links;
    protected $linksFromExisting;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Menu", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Menu", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Link")
     */
    protected $connectorElement;

       /**
     * Set type
     *
     * @param integer $type
     * @return Menu
     */
    public function setType($type)
    {

        if (!array_key_exists($type, self::$types)) {
            throw new \InvalidArgumentException('Theres no such type of menu - ' . $type);
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
    public function getTypeName()
    {
        return self::$types[$this->type];
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
     * Set position
     *
     * @param integer $position
     * @return Menu
     */
    public function setPosition($position)
    {
        if (!in_array($position, self::$positions)) {
            throw new InvalidArgumentException();
        }
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get position name
     *
     * @return string
     */
    public function getPositionName()
    {
        return self::$positions[$this->position];
    }

    /**
     * Get position list
     *
     * @return array
     */
    public static function getPositionList()
    {
        return self::$positions;
    }


    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->linksFromExisting= new ArrayCollection();
    }

    public function addLink(Link $link)
    {
        if (!$this->links->contains($link)) {
            $this->links->add($link);
        }
        return $this;
    }

    public function getLinksFromExisting()
    {

    }

    public function addLinksFromExisting(Link $link)
    {
        $this->links[] = $link;
        return $this;
    }

    public function removeLinksFromExisting(Link $link)
    {
        var_dump($link);
    }

    public function removeLink(Link $link)
    {
        $this->links->removeElement($link);
        return $this;
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function setParent(Menu $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function __toString()
    {
        $prefix = "";
        for ($i = 2; $i <= $this->lvl; $i++) {
            $prefix .= "& nbsp;& nbsp;& nbsp;& nbsp;";
        }
        return $prefix . $this->name;
    }

   /**
     * @param mixed $connectorElement
     */
    public function setConnectorElement($connectorElement)
    {
        $this->connectorElement = $connectorElement;
    }

    /**
     * @return mixed
     */
    public function getConnectorElement()
    {
        return $this->connectorElement;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
