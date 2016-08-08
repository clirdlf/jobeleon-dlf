<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package wpjobboard_theme
 * @since wpjobboard_theme 1.0
 */

$is_map = basename( get_page_template() ) == "home-map.php";
$full_width = in_array( basename( get_page_template() ), array("full-width.php", "home-map.php") );
?>

<?php if(!$is_map): ?>
</div><!-- #main .site-main -->
</div><!-- #primary .primary -->
<?php endif; ?>

<?php if( !$full_width ): ?>
<?php get_sidebar(); ?>
<?php endif; ?>

<?php if(!$is_map): ?>
</div><!-- .table-row -->
<?php endif; ?>

<footer id="footer" class="<?php echo $full_width ? "footer-full-width" : "" ?>" role="contentinfo">
    <nav class="footer-navigation">
        <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
    </nav>
    <div class="footer-content">
        <p>Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a> and <a href="http://wpjobboard.net/" target="_blank">WPJobBoard</a></p>
    </div>
</footer><!-- #colophon .site-footer -->



</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
