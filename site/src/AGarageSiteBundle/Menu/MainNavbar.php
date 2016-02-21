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

class MainNavbar implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function leftNavbar(FactoryInterface $factory, array $options = array()) {
        $translator = $this->container->get('translator');

        $menu = $factory->createItem('root', $options);

        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('homepage', [
            'route' => 'homepage',
            'label' => $translator->trans('main_navbar.homepage'),
        ]);
        $menu->addChild('blog', [
            'route' => 'blog',
            'label' => $translator->trans('main_navbar.blog'),
        ]);

        return $menu;
    }
}