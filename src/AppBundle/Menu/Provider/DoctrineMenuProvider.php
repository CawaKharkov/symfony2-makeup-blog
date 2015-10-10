<?php

namespace AppBundle\Menu\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\Provider\MenuProviderInterface;

/**
 * Class DoctrineMenuProvider
 * @package AppBundle\Menu\Provider
 */
class DoctrineMenuProvider implements MenuProviderInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory = null;

    protected $em = null;


    /**
     * @param FactoryInterface $factory the menu factory used to create the menu item
     */
    public function __construct(FactoryInterface $factory, EntityManagerInterface $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    /**
     * Retrieves a menu by its name
     *
     * @param string $name
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     * @throws \InvalidArgumentException if the menu does not exists
     */
    public function get($name, array $options = array())
    {
        if (!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('The menu "%s" is not defined.', $name));
        }

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $items = $this->em->getRepository('AppBundle:Menu')->findOneByName($name);

        $links = $items->getLinks();
        if ($items && count($links)) {
            foreach ($links as $link) {
                $menu->addChild($link->getTitle(), array('uri' => $link->getRoute()));
            }
        }



        /* $menu->addChild('user', array('label' => 'Hi visitor'))
             ->setAttribute('dropdown', true);
         $menu['user']->addChild('Edit profile', array('route' => 'homepage'));

         $menu->addChild('Home', array('route' => 'homepage'));*/

        return $menu;

    }

    /**
     * Checks whether a menu exists in this provider
     *
     * @param string $name
     * @param array $options
     * @return bool
     */
    public function has($name, array $options = array())
    {
        $menu = 'mm';/* find the menu called $name */;

        return $menu !== null;
    }
}