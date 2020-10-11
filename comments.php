<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <div class="prose prose-lg pl-4 pr-4 mx-auto">
        <?php
        // You can start editing here -- including this comment!
        if (have_comments()) :
            ?>
            <h2 class="comments-title">
                <?php
                $_s_comment_count = get_comments_number();
                if ('1' === $_s_comment_count) {
                    printf(
                    /* translators: 1: title. */
                        esc_html__('One thought on &ldquo;%1$s&rdquo;', '_s'),
                        '<span>' . wp_kses_post(get_the_title()) . '</span>'
                    );
                } else {
                    printf(
                    /* translators: 1: comment count number, 2: title. */
                        esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $_s_comment_count, 'comments title', '_s')),
                        number_format_i18n($_s_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        '<span>' . wp_kses_post(get_the_title()) . '</span>'
                    );
                }
                ?>
            </h2><!-- .comments-title -->



            <?php
            the_comments_navigation();

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open()) :
                ?>
                <p class="no-comments"><?php esc_html_e('Comments are closed.', '_s'); ?></p>
            <?php
            endif;

        endif; // Check for have_comments().

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $html_req = ($req ? " required='required'" : '');
        $html5 = true;

        $comment_args = array(
            'fields' => array(
                'author' => sprintf(
                    '<p class="comment-form-author">%s %s</p>',
                    sprintf(
                        '<label for="author">%s%s</label>',
                        __('Name'),
                        ($req ? ' <span class="required">*</span>' : '')
                    ),
                    sprintf(
                        '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245"%s />',
                        esc_attr($commenter['comment_author']),
                        $html_req
                    )
                ),
                'email' => sprintf(
                    '<p class="comment-form-email">%s %s</p>',
                    sprintf(
                        '<label for="email">%s%s</label>',
                        __('Email'),
                        ($req ? ' <span class="required">*</span>' : '')
                    ),
                    sprintf(
                        '<input id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
                        ($html5 ? 'type="email"' : 'type="text"'),
                        esc_attr($commenter['comment_author_email']),
                        $html_req
                    )
                ),
                'url' => sprintf(
                    '<p class="comment-form-url">%s %s</p>',
                    sprintf(
                        '<label for="url">%s</label>',
                        __('Website')
                    ),
                    sprintf(
                        '<input id="url" name="url" %s value="%s" size="30" maxlength="200" />',
                        ($html5 ? 'type="url"' : 'type="text"'),
                        esc_attr($commenter['comment_author_url'])
                    )
                ),
            ),
            'comment_field' => sprintf(
                '<p class="comment-form-comment">%s</p>',
                sprintf(
                    '<textarea id="comment" class="bg-white rounded border border-gray-400 focus:outline-none h-32 focus:border-indigo-500 text-base px-4 py-2 mb-4 w-full resize-none" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="%s"></textarea>',
                    _x('Comment', 'noun')
                )
            ),
            'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg cursor-pointer" value="%4$s" />',
            'format' => 'html5'
        );

        comment_form($comment_args); ?>
    </div>
    <div class="max-w-6xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">

        <section class="text-gray-700 body-font overflow-hidden">
            <div class="container px-5 py-8 mx-auto">
                <div class="-my-8">
                    <?php
                    wp_list_comments(
                        array(
                            'style' => 'div',
                            'short_ping' => true,
                            'walker' => new Tailwindcss_CommentWalker(),
                            'format' => 'html5'
                        )
                    );
                    ?>
                </div>
            </div>
        </section>

        <?php the_comments_navigation(); ?>
    </div>

</div><!-- #comments -->




