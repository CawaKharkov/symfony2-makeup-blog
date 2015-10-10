<?php
// src/AppBundle/Menu/Builder.php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MainBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('User', array('label' => 'Hi visitor'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'fa fa-user');
        $menu['User']->addChild('Edit profile', array('route' => 'homepage'))
            ->setAttribute('icon', 'fa fa-edit');

        return $menu;
    }
}