<?php
/**
 * @package wpjobboard_theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
            <?php wpjobboard_theme_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'jobeleon'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php edit_post_link(__('Edit', 'jobeleon'), '<span class="edit-link">', '</span>'); ?>
        <div class="author-box">
            <h2 class="ab-header"><?php _e('Author', 'jobeleon') ?></h2>
            <div class="media">
                <div class="m-content-wrapper">
                    <div class="m-image-wrapper">
                        <?php echo get_avatar(get_the_author_meta('ID'), 96); ?>
                    </div>
                    <h2 class="m-head"><?php the_author_posts_link(); ?></h2>
                    <p class="m-desc"><?php the_author_meta('description'); ?></p>
                </div><!-- .m-content-wrapper -->
            </div><!-- .media -->
        </div><!-- .author-box .media -->
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
