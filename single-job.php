<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wpjobboard_theme
 */
get_header();
global $post_type;
?>

<div class="where-am-i">
    <?php if($post_type == "job"): ?>
    <h2><?php _e('Job', 'jobeleon'); ?></h2>
    <?php elseif ($post_type == "company"): ?>
    <h2><?php _e('Company', 'jobeleon'); ?></h2>
    <?php elseif ($post_type == "resume"): ?>
    <h2><?php _e('Resume', 'jobeleon'); ?></h2>
    <?php endif; ?>
</div><!-- .where-am-i -->
        
        
<div id="content" class="site-content" role="main">
    <?php while (have_posts()) : the_post(); ?>




        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-## -->

        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || '0' != get_comments_number())
            comments_template();
        ?>

    <?php endwhile; // end of the loop. ?>

</div><!-- #content -->

<?php get_footer(); ?>
