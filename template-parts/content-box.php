<?php
    global $tailwind_theme;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
        <a href="<?php esc_url(get_permalink()); ?>" class="">
            <div class="flex-shrink-0">
                <!--            <img class="h-48 w-full object-cover"-->
                <!--                 src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"-->
                <!--                 alt="">-->
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium_large', array(
                        "class" => "object-cover h-48 w-full"
                    ));
                } else {
                    echo '<img src="' . get_stylesheet_directory_uri() . '/img/unsplash/' . rand(1, 42) . '.jpg" class="object-cover h-48 w-full" />';
                }
                ?>
            </div>
            <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                <div class="flex-1">
                    <p class="text-sm leading-5 font-medium text-indigo-600">
                        <?php the_category(', '); ?>
                    </p>
                    <a href="<?php esc_url(get_permalink()); ?>" class="block">
                        <h3 class="entry-title mt-2 text-xl leading-7 font-semibold text-gray-900">
                            <?php the_title('<a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>'); ?>
                        </h3>
                        <p class="mt-3 text-base leading-6 text-gray-500">
                            <?php the_excerpt(); ?>
                        </p>
                    </a>
                </div>
                <div class="mt-6 flex items-center">
                    <div class="flex-shrink-0">
                        <a href="#">
                            <?php
                                echo get_avatar(get_the_author(), 80, 'gravatar_default', null, array(
                                    'class' => 'h-10 w-10 rounded-full'
                                ));
                            ?>
                        </a>
                    </div>
                    <div class="ml-3 flex-grow flex flex-row justify-between items-end">
                        <div>
                            <p class="text-sm leading-5 font-medium text-gray-900">
                                <a href="#" class="hover:underline">
                                    <?php the_author(); ?>
                                </a>
                            </p> <!-- Author image -->
                            <div class="flex text-sm leading-5 text-gray-500">
                                <time datetime="2020-03-16">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div><!-- Author name -->
                        </div>
                        <div>
                            <span class="text-gray-600 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-300">
                            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                                <?php echo $tailwind_theme->functions->getViewCount(get_the_ID());  ?>
                        </span><!-- Views -->
                            <span class="text-gray-600 inline-flex items-center leading-none text-sm">
                            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round" viewBox="0 0 24 24">
                              <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                            </svg><?php echo get_comments_number(get_the_ID());  ?>
                        </span><!-- Comment count -->
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


</article><!-- .post -->
