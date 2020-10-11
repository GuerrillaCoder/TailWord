<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_link = get_previous_posts_link(  );
$prev_link = get_next_posts_link(  );

$next_post_page = get_previous_posts_page_link();
$prev_post_page = get_next_posts_page_link();

if ($next_link || $prev_link) {

    $pagination_classes = '';

    if (!$next_link) {
        $pagination_classes = ' only-one only-prev';
    } elseif (!$prev_link) {
        $pagination_classes = ' only-one only-next';
    }

    ?>
    <nav class="w-full py-8 overflow-hidden  <?php echo esc_attr($pagination_classes); ?>"
         aria-label="<?php esc_attr_e('Post', 'tailwindcss'); ?>" role="navigation">


        <?php
        if ($prev_link) {
            ?>
            <div class="prose float-left">
                <a class="previous-post max-w-full " href="<?php echo esc_url($prev_post_page); ?>">
                    <div class="border border-solid rounded-md items-center  mb-2 flex p-3 max-w-full truncate bg-white">
                        <svg
                            class="w-6 h-6 mr-4 "
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            ></path>
                        </svg>
                        <span class="title mr-4 whitespace-no-wrap max-w-full truncate  bg-white">Older Posts</span>
                    </div>
                </a>
            </div>


            <?php
        }

        if ($next_link) {
            ?>
            <div class="prose float-right">
                <a class="next-post max-w-full" href="<?php echo esc_url($next_post_page); ?>">

                    <div class="border border-solid rounded-md items-center mb-2 flex p-3 max-w-full truncate bg-white">
                        <spam class="title whitespace-no-wrap mr-4 ml-4">Newer Posts</spam>
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            ></path>
                        </svg>
                    </div>
                </a>
            </div>

            <?php
        }
        ?>

    </nav><!-- .pagination-single -->

    <?php
}
