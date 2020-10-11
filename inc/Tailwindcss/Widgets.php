<?php

class Tailwindcss_Widgets
{

    public function __construct()
    {
        add_action( 'widgets_init', array($this,'registerWidgets' ));
    }

    function registerWidgets() {

        register_sidebar( array(
            'name'          => 'Footer Widget 1',
            'id'            => 'footer_widget_1',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="text-sm leading-5 font-semibold tracking-wider text-gray-400 uppercase">',
            'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
            'name'          => 'Footer Widget 2',
            'id'            => 'footer_widget_2',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="text-sm leading-5 font-semibold tracking-wider text-gray-400 uppercase">',
            'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
            'name'          => 'Footer Widget 3',
            'id'            => 'footer_widget_3',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="text-sm leading-5 font-semibold tracking-wider text-gray-400 uppercase">',
            'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
            'name'          => 'Footer Widget 4',
            'id'            => 'footer_widget_4',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="text-sm leading-5 font-semibold tracking-wider text-gray-400 uppercase">',
            'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
            'name'          => 'Footer Widget 5',
            'id'            => 'footer_widget_5',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="text-sm leading-5 font-semibold tracking-wider text-gray-400 uppercase">',
            'after_title'   => '</h4>',
        ) );

    }
}