<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package wpjobboard_theme
 * @since 1.2.0
 */
get_header();
?>
<?php if (!jobeleon_is_wpjb()) :  ?>
    <div class="where-am-i" style="min-height:35px">
        <!--h2><?php the_title(); ?></h2--> 
    </div><!-- .where-am-i -->
<?php endif; ?>

<div id="content" class="site-content full-width" role="main">
    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || '0' != get_comments_number())
            comments_template();
        ?>

    <?php endwhile; // end of the loop. ?>

</div><!-- #content -->

<?php get_footer(); ?>
