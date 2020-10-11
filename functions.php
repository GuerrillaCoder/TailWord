<?php
spl_autoload_register( 'tailwindcss_autoloader' );
function tailwindcss_autoloader( $class_name ) {
    if ( false !== strpos( $class_name, 'Tailwindcss' ) ) {
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR;
        $class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
        require_once $classes_dir . $class_file;
    }
}

$tailwind_theme = new Tailwindcss_Theme();

