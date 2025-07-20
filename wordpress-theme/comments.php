<?php
/**
 * The template for displaying comments
 *
 * @package Future_Frontiers_HQ
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

<div id="comments" class="comments-area mt-8">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="comments-title text-2xl font-bold mb-6">
            <?php
            $ffhq_comment_count = get_comments_number();
            if ('1' === $ffhq_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'future-frontiers-hq'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $ffhq_comment_count, 'comments title', 'future-frontiers-hq')),
                    number_format_i18n($ffhq_comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'callback'   => 'ffhq_comment_callback',
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation(
            array(
                'prev_text' => '<span class="nav-previous">' . esc_html__('&larr; Older Comments', 'future-frontiers-hq') . '</span>',
                'next_text' => '<span class="nav-next">' . esc_html__('Newer Comments &rarr;', 'future-frontiers-hq') . '</span>',
            )
        );

    endif;

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments text-gray-600"><?php esc_html_e('Comments are closed.', 'future-frontiers-hq'); ?></p>
        <?php
    endif;

    comment_form(
        array(
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-bold mb-4">',
            'title_reply_after'  => '</h3>',
            'class_submit'       => 'submit bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition',
            'label_submit'       => __('Post Comment', 'future-frontiers-hq'),
            'comment_field'      => '<p class="comment-form-comment mb-4"><label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . _x('Comment', 'noun', 'future-frontiers-hq') . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea></p>',
            'fields'             => array(
                'author' => '<p class="comment-form-author mb-4"><label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . __('Name', 'future-frontiers-hq') . ' <span class="required text-red-500">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" /></p>',
                'email'  => '<p class="comment-form-email mb-4"><label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . __('Email', 'future-frontiers-hq') . ' <span class="required text-red-500">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" /></p>',
                'url'    => '<p class="comment-form-url mb-4"><label for="url" class="block text-sm font-medium text-gray-700 mb-2">' . __('Website', 'future-frontiers-hq') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" /></p>',
            ),
        )
    );
    ?>

</div>

<?php
// Custom comment callback
function ffhq_comment_callback($comment, $args, $depth) {
    ?>
    <li <?php comment_class('mb-6 p-6 bg-gray-50 rounded-lg'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="flex items-start">
            <div class="flex-shrink-0 mr-4">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
            </div>
            <div class="flex-1">
                <div class="comment-meta mb-2">
                    <cite class="comment-author font-semibold text-gray-900">
                        <?php echo get_comment_author_link(); ?>
                    </cite>
                    <span class="comment-date text-sm text-gray-500 ml-2">
                        <?php echo get_comment_date() . ' at ' . get_comment_time(); ?>
                    </span>
                </div>
                
                <div class="comment-content text-gray-700">
                    <?php comment_text(); ?>
                </div>
                
                <div class="comment-actions mt-2">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => 'comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<span class="text-sm text-blue-600 hover:text-blue-800">',
                                'after'     => '</span>',
                            )
                        )
                    );
                    ?>
                </div>
                
                <?php if ($comment->comment_approved == '0') : ?>
                    <p class="comment-awaiting-moderation text-sm text-yellow-600 mt-2">
                        <?php esc_html_e('Your comment is awaiting moderation.', 'future-frontiers-hq'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php
}
