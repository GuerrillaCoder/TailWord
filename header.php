<?php

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>



<header>

    <?php

    // Check whether the header search is activated in the customizer.
    $enable_header_search = get_theme_mod('enable_header_search', true);

    if (true === $enable_header_search) {

        ?>

        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                <div class="flex justify-between h-16">

                    <div class="flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end">
                        <div class="max-w-lg w-full lg:max-w-xs">
                            <form role="search" method="get" id="searchform" class="searchform"
                                  action="/">
                                <label for="s" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <input id="s" name="s"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                                           placeholder="Search" type="search">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .search-toggle -->
        </nav>
    <?php } ?>


    <div x-data="{ mobileMenuOpen: false }" class="relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="lg:w-0 lg:flex-1 logo">
                    <a href="<?php get_home_url(); ?>" class="flex max-h-8">
                        <?php
                        if (function_exists('the_custom_logo')) {

                            if (has_custom_logo()) {
//                                the_custom_logo();
                                $logo = get_theme_mod( 'custom_logo' );
                                $image = wp_get_attachment_image_src( $logo , 'full' );
                                echo '<img class="max-w-300"
                             src="'.$image[0].'" alt="Workflow">';

                            } else {
                                echo '<img class="h-8 w-auto sm:h-10"
                             src="https://tailwindui.com/img/logos/v1/workflow-mark-on-white.svg" alt="Workflow">';
                            }
                        }

                        ?>

                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <button @click="mobileMenuOpen = true" type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <nav class="hidden md:flex space-x-10">
                    <?php if (has_nav_menu('header-menu')) {

                        wp_nav_menu(
                            array(
                                'container' => '',
                                'items_wrap' => '%3$s',
                                'theme_location' => 'header-menu',
                                'walker' => new Tailwindcss_NavWalker()
                            )
                        );
                    } ?>
                </nav>

                <div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0">
                    <a href="<?php echo wp_login_url(); ?>"
                       class="whitespace-no-wrap text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                        Sign in
                    </a>

                    <?php
                    $reg_url = wp_registration_url();
                    if(get_option( 'users_can_register' ) && !empty($reg_url))
                    {
                        ?>
                        <span class="inline-flex rounded-md shadow-sm">
                            <a href="<?php echo $reg_url; ?>"
                               class="whitespace-no-wrap inline-flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                              Sign up
                            </a>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div x-description="Mobile menu, show/hide based on mobile menu state." x-show="mobileMenuOpen"
             x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in"
             x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
             class=" z-50 absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <div class="rounded-lg shadow-lg">
                <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
                    <div class="pt-5 pb-6 px-5 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <img class="h-8 w-auto"
                                     src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Workflow">
                            </div>
                            <div class="-mr-2">
                                <button @click="mobileMenuOpen = false" type="button"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <nav class="grid gap-y-8">
                                <?php if (has_nav_menu('header-menu')) {

                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'header-menu',
                                            'walker' => new Tailwindcss_MobileNavWalker()
                                        )
                                    );
                                } ?>

                            </nav>
                        </div>
                    </div>
                    <div class="py-6 px-5 space-y-6">

                        <div class="space-y-6">
              <span class="w-full flex rounded-md shadow-sm">
                  <?php
                  $reg_url = wp_registration_url();
                  if (get_option( 'users_can_register' ) && !empty($reg_url)) {
                      ?>
                      <a href="<?php echo $reg_url; ?>"
                         class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                          Sign up
                        </a>
                      <?php
                  }
                  ?>

              </span>
                            <p class="text-center text-base leading-6 font-medium text-gray-500">
                                Existing customer?
                                <a href="<?php echo wp_login_url(); ?>"
                                   class="text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>

<?php
wp_body_open();
?>