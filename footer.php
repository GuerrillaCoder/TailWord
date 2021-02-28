<?php

$locations      = get_registered_nav_menus();
$menu_locations = get_nav_menu_locations();

$footer_1_title = "";
$footer_2_title = "";
$footer_3_title = "";
$footer_4_title = "";

if(isset($menu_locations["footer-menu-1"]))
{
    $footer = get_term_by('id', $menu_locations["footer-menu-1"], 'nav_menu');
    $footer_1_title = get_field('menu_header', $footer);
}
if(isset($menu_locations["footer-menu-2"]))
{
    $footer = get_term_by('id', $menu_locations["footer-menu-2"], 'nav_menu');
    $footer_2_title = get_field('menu_header', $footer);
}
if(isset($menu_locations["footer-menu-3"]))
{
    $footer = get_term_by('id', $menu_locations["footer-menu-3"], 'nav_menu');
    $footer_3_title = get_field('menu_header', $footer);
}
if(isset($menu_locations["footer-menu-4"]))
{
    $footer = get_term_by('id', $menu_locations["footer-menu-4"], 'nav_menu');
    $footer_4_title = get_field('menu_header', $footer);
}

?>


<div class="bg-white">
    <div class="max-w-screen-xl mx-auto pb-12 px-4 sm:px-6 lg:py-16 lg:px-8 ">

            <div class="flex flex-wrap justify-around  xl:mt-0 ">
                <?php if ( is_active_sidebar( 'footer_widget_1' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area w-full md:w-4/12 xl:3/12" role="complementary">
                        <?php dynamic_sidebar( 'footer_widget_1' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer_widget_2' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area  w-full md:w-4/12 xl:3/12" role="complementary">
                        <?php dynamic_sidebar( 'footer_widget_2' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer_widget_3' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area  w-full md:w-4/12 xl:3/12" role="complementary">
                        <?php dynamic_sidebar( 'footer_widget_3' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer_widget_4' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area  w-full md:w-4/12 xl:3/12" role="complementary">
                        <?php dynamic_sidebar( 'footer_widget_4' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer_widget_5' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area  w-full md:w-4/12 xl:3/12" role="complementary">
                        <?php dynamic_sidebar( 'footer_widget_5' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
            </div>
        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base leading-6 text-gray-400 xl:text-center">
                &copy; 2021 Turma, LLC. All rights reserved.
            </p>
        </div>
    </div>
</div>


<?php wp_footer(); ?>

</body>
</html>

