<?php
get_header();
?>

    <main id="primary" class="site-main">

        <?php if (have_posts()) : ?>

        <div class="relative bg-gray-50 pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
            <div class="relative max-w-7xl mx-auto">
                <div class="text-center">
                    <?php
                    the_archive_title('<h2 class="text-3xl leading-9 tracking-tight font-extrabold text-gray-900 sm:text-4xl sm:leading-10">', '</h2>');
                    the_archive_description('<p class="mt-3 max-w-2xl mx-auto text-xl leading-7 text-gray-500 sm:mt-4">', '</p>');
                    ?>
                </div>
                <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">

                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'box');

                    endwhile;

                    echo '</div>';

                    $nav_args = array(
                        'prev_text'          => _x( 'Previous', 'previous set of posts' ),
                        'next_text'          => _x( 'Next', 'next set of posts' ),
                        'class'              => 'pagination',
                    );

//                    the_posts_navigation();
                    get_template_part('template-parts/navigation', 'archive');

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>


            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();