<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ($next_post || $prev_post) {

    $pagination_classes = '';

    if (!$next_post) {
        $pagination_classes = ' only-one only-prev';
    } elseif (!$prev_post) {
        $pagination_classes = ' only-one only-next';
    }

    ?>
    <nav class="container flex-wrap relative py-4 bg-white overflow-hidden justify-between items-center <?php echo esc_attr($pagination_classes); ?>"
         aria-label="<?php esc_attr_e('Post', 'tailwindcss'); ?>" role="navigation">


        <?php
        if ($prev_post) {
            ?>

            <a class="previous-post max-w-full float-left" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                <div class="border border-solid rounded-md items-center  mb-2 flex p-3 max-w-full truncate">
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
                    <span class="title mr-4 whitespace-no-wrap max-w-full truncate"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span>
                </div>
            </a>

            <?php
        }

        if ($next_post) {
            ?>

            <a class="next-post max-w-full float-right" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">

                <div class="border border-solid rounded-md items-center mb-2 flex p-3 max-w-full truncate">
                    <spam class="title whitespace-no-wrap mr-4 ml-4"><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></spam>
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
            <?php
        }
        ?>

    </nav><!-- .pagination-single -->

    <?php
}
