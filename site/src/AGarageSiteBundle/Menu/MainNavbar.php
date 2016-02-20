<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午1:08
 */

namespace AGarage\Site\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MainNavbar implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function leftNavbar(FactoryInterface $factory, array $options = array()) {
        $translator = $this->container->get('translator');

        $menu = $factory->createItem('root');
        $options = array_merge($options, [
            'currentClass' => 'active'
        ]);
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('homepage', [
            'route' => 'homepage',
            'label' => $translator->trans('main_navbar.homepage'),
        ]);

        return $menu;
    }
}