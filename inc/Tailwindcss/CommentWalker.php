<?php
class Tailwindcss_CommentWalker extends Walker_Comment {

    private $comment_count = 0;
    /**
     * Outputs a comment in the HTML5 format.
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $this->comment_count++;

        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $commenter          = wp_get_current_commenter();
        $show_pending_links = ! empty( $commenter['comment_author'] );

        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
        }
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body py-8 flex flex-wrap md:flex-no-wrap <?php echo $this->comment_count == 1 ? "" :  "border-t-2 border-gray-200 ";  ?>">
            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col <?php echo $depth > 1 ? "ml-16" : ""  ?>">
                <footer class="comment-meta">
                    <div class="comment-author vcard  tracking-widest font-medium title-font text-gray-900">
                        <?php
                        if ( 0 != $args['avatar_size'] ) {
                            echo get_avatar( $comment, $args['avatar_size'] );
                        }
                        ?>
                        <div class="tracking-widest font-medium title-font text-gray-900">
                        <?php
                        $comment_author = get_comment_author_link( $comment );

                        if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
                            $comment_author = get_comment_author( $comment );
                        }

                        printf(
                        /* translators: %s: Comment author link. */
                            __( '%s <span class="says">says:</span>' ),
                            sprintf( '<b class="fn">%s</b>', $comment_author )
                        );
                        ?>
                        </div>
                    </div><!-- .comment-author -->

                    <div class="comment-metadata mt-1 text-gray-400 text-sm">
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <time class="text-sm" datetime="<?php comment_time( 'c' ); ?>">
                                <?php
                                /* translators: 1: Comment date, 2: Comment time. */
                                printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                                ?>
                            </time>
                        </a>

                    </div><!-- .comment-metadata -->

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->
            </div>
            <div class="md:flex-grow">
                <div class="comment-content">
                    <?php
                    comment_text(0, array('class' => 'leading-relaxed'));
//                    comment_text();
                    ?>

                    <?php edit_comment_link(
                            sprintf('%s <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>',__( 'Edit' )),
                        '<span class="edit-link">', '</span>' ); ?>
                    <?php
                    if ( '1' == $comment->comment_approved || $show_pending_links ) {
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply text-indigo-500 inline-flex items-center mt-4">',
                                    'after'     => '</div>',
                                    'reply_text'    => sprintf('%s  <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>', __( 'Reply' )),
                                    /* translators: Comment reply button text. %s: Comment author name. */
                                    'reply_to_text' => sprintf('%s  <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>', __( 'Reply to %s' )),
                                    'login_text'    => sprintf('%s  <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>', __( 'Log in to Reply' ))
                                )
                            )
                        );
                    }
                    ?>
                </div><!-- .comment-content -->
            </div>



        </article><!-- .comment-body -->
        <?php
    }
}