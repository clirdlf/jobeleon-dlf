<?php
/**
 * The Template for displaying all single posts.
 *
 * @package wpjobboard_theme
 */
get_header();
?>

<div class="where-am-i">
    <h2>
        <?php
        if ('post' == get_post_type()) :
            _e('The blog', 'jobeleon');
        endif;
        ?>
    </h2>
</div>
<div id="content" class="site-content" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'single'); ?>

        <?php wpjobboard_theme_content_nav('nav-below'); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || '0' != get_comments_number())
            comments_template();
        ?>

    <?php endwhile; // end of the loop.  ?>

</div><!-- #content -->

<?php get_footer(); ?>
