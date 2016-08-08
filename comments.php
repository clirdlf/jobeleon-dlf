<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to wpjobboard_theme_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package wpjobboard_theme
 */
?>

<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(_nx('%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'jobeleon'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
            ?>
        </h2>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-above" class="navigation-comment" role="navigation">
                <h1 class="screen-reader-text"><?php _e('Comment navigation', 'jobeleon'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'jobeleon')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'jobeleon')); ?></div>
            </nav><!-- #comment-nav-before -->
        <?php endif; // check for comment navigation  ?>

        <ol class="comment-list">
            <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use wpjobboard_theme_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define wpjobboard_theme_comment() and that will be used instead.
             * See wpjobboard_theme_comment() in inc/template-tags.php for more.
             */
            wp_list_comments(array('callback' => 'wpjobboard_theme_comment'));
            ?>
        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-below" class="navigation-comment" role="navigation">
                <h1 class="screen-reader-text"><?php _e('Comment navigation', 'jobeleon'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'jobeleon')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'jobeleon')); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation  ?>

    <?php endif; // have_comments()  ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'jobeleon'); ?></p>
    <?php endif; ?>

    <?php
    
    if(!isset($aria_req)) {
        $aria_req = "";
    }
    
    $name = __('Your name', 'jobeleon');
    $email = __('Your email', 'jobeleon');
    $comment = __('Your message', 'jobeleon');
    $fields = array(
        'author' => '<p class="comment-form-author"><label for="author" class="screen-reader-text">' . $name . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' placeholder="' . $name . '" required /></p>',
        'email' => '<p class="comment-form-email"><label for="email" class="screen-reader-text">' . $email . '</label> ' . '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . $email . '" required /></p>',
    );
    $comment_field = '<p class="comment-form-comment"><label for="comment" class="screen-reader-text">' . $comment . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . $comment . '"></textarea></p>';

    echo '<div class="respond-area">';
    comment_form(array(
        'title_reply' => __('Write your comment', 'jobeleon'),
        'fields' => $fields,
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'comment_field' => $comment_field,
        'label_submit' => _x('Submit', 'submit a comment', 'jobeleon'),
    ));
    echo '</div><!-- .respond-area -->'
    ?>
</div><!-- #comments -->
