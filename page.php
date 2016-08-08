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

function jobeleon_old_single_item() {

    if(Wpjb_Project::getInstance()->conf("urls_mode")==2) {
        return false;
    }
    
    if(wpjb_is_routed_to("index.single") || wpjb_is_routed_to("index.company")) {
        return true;
    }
    
    if(wpjb_is_routed_to("index.view", "resumes")) {
        return true;
    }
    
    return false;
}

?>
<?php if (!jobeleon_is_wpjb() || jobeleon_old_single_item()) :  ?>
    <div class="where-am-i" style="min-height:35px">
        <!--h2><?php the_title(); ?></h2--> 
    </div><!-- .where-am-i -->
<?php endif; ?>

<div id="content" class="site-content" role="main">
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
