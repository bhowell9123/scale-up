<?php

namespace App\View\Composers;

// Removed Acorn dependency
class App
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function getData()
    {
        return [
            'siteName' => get_bloginfo('name'),
            'siteDescription' => get_bloginfo('description'),
            'primaryNavigation' => wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'menu_class' => 'nav-menu flex items-center space-x-6',
                'container' => false,
                'echo' => false,
            ]),
            'footerNavigation' => wp_nav_menu([
                'theme_location' => 'footer_navigation',
                'menu_class' => 'footer-menu flex flex-wrap space-x-4',
                'container' => false,
                'echo' => false,
            ]),
        ];
    }
}