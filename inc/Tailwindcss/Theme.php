<?php

class Tailwindcss_Theme{

    public $nav;
    public $widgets;
    public $functions;

    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'addCss' ));
        add_action( 'wp_enqueue_scripts', array($this, 'addJs' ));

        add_action( 'admin_enqueue_scripts', array($this, 'addCssAdmin' ));
        add_action( 'admin_enqueue_scripts', array($this, 'addJsAdmin' ));

        add_action( 'customize_register', array( $this, 'customize' ) );

        $this->nav = new Tailwindcss_ThemeNav();
        $this->widgets = new Tailwindcss_Widgets();
        $this->functions = new Tailwindcss_ThemeFunctions();

        add_action( 'after_setup_theme', array($this,'addSupport'));
        add_action( 'init', array($this,'registerCss'));

    }

    public function registerCss()
    {
        wp_register_style('dx-common',get_theme_file_uri('vendor/css/dx.common.css') ,
            array(), filemtime(get_theme_file_path('vendor/css/dx.common.css')));

        wp_register_style('dx-theme',get_theme_file_uri('vendor/css/dx.light.css') ,
            array("dx-common"), filemtime(get_theme_file_path('vendor/css/dx.light.css')));
    }

    public function addCss()
    {
        $css_path = get_theme_file_uri('dist/main.css');
        $css_file_path = get_theme_file_path('dist/main.css');
        $vendor_css_path = get_theme_file_uri('dist/vendor.css');
        $vendor_css_file_path = get_theme_file_path('dist/vendor.css');

        wp_enqueue_style( 'main-css', $css_path, array(), filemtime($css_file_path) );
        wp_enqueue_style( 'vendor-css', $vendor_css_path, array(), filemtime($vendor_css_file_path) );
    }

    public function addJs()
    {
        $js_path = get_theme_file_uri( '/dist/bundle.js');
        $js_file_path = get_theme_file_path('/dist/bundle.js');
        wp_enqueue_script( 'main-js', $js_path, array(), filemtime($js_file_path), true );
//        wp_enqueue_script( 'main-js', $js_path, array(), null, true );
    }

    public function addCssAdmin()
    {
        $css_path = get_theme_file_uri( '/dist/admin.css');
        $css_file_path = get_theme_file_path('/dist/admin.css');
        wp_enqueue_style( 'admin-main-css', $css_path, array(), filemtime($css_file_path) );
//        wp_enqueue_style( 'tailwind-css', $css_path, array() );

        $vendor_css_path = get_theme_file_uri('/dist/admin-vendor.css');
        wp_enqueue_style( 'vendor-css', $vendor_css_path, array(), filemtime($css_file_path) );


        wp_enqueue_style( 'dx-common');
        wp_enqueue_style( 'dx-theme');
    }

    public function addJsAdmin()
    {
        $js_path = get_theme_file_uri('/dist/bundle.js');
        $js_path_path = get_theme_file_path('/dist/bundle.js');
        wp_enqueue_script( 'main-js', $js_path, array(), filemtime($js_path_path), true );
//        wp_enqueue_script( 'main-js', $js_path, array(), null, true );
    }

    public function customize( $wp_customize )
    {

        $wp_customize->add_section(
            'options',
            array(
                'title'      => __( 'Theme Options', 'tailwindcss' ),
                'priority'   => 40,
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_setting(
            'enable_header_search',
            array(
                'capability'        => 'edit_theme_options',
                'default'           => true,
            )
        );

        $wp_customize->add_control(
            'enable_header_search',
            array(
                'type'     => 'checkbox',
                'section'  => 'options',
                'priority' => 10,
                'label'    => __( 'Show search in header', 'tailwindcss' ),
            )
        );
    }

    function addSupport(){
        add_post_type_support( 'page', 'excerpt' );

        add_theme_support( 'custom-logo' );
    }
}