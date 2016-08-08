<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package wpjobboard_theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!jobeleon_is_wpjb()) : ?>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->
    <?php endif; ?>
        
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'jobeleon'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
    <?php edit_post_link(__('Edit', 'jobeleon'), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>'); ?>
</article><!-- #post-## -->
