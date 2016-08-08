<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpjobboard_theme
 * @since wpjobboard_theme 1.0
 */
get_header();
?>

<div class="where-am-i">
    <?php if ('post' == get_post_type()) : ?>
        <h2><?php _e('The blog', 'jobeleon'); ?></h2>
    <?php endif; ?>
    <?php if (is_search()) : ?>
        <p><?php printf(__('Search result for: %1$s', 'jobeleon'), $_GET['s']); ?></p>
    <?php elseif (is_404()) : ?>
        <h2>404</h2>
    <?php endif; ?>
</div>
<div id="content" class="site-content" role="main">
    <?php if (have_posts()) : ?>

        <?php /* Start the Loop */ ?>
        <?php while (have_posts()) : the_post(); ?>

            <?php
            /* Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('content', get_post_format());
            ?>

        <?php endwhile; ?>

        <?php wpjobboard_theme_content_nav('nav-below'); ?>

    <?php else : ?>

        <?php get_template_part('no-results', 'index'); ?>

    <?php endif; ?>

</div><!-- #content .site-content -->

<?php get_footer(); ?>
