<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package wpjobboard_theme
* @since wpjobboard_theme 1.0
*/

$is_map = basename(get_page_template()) == "home-map.php";
$full_width = in_array(basename(get_page_template()), array("full-width.php", "home-map.php"));
?>

<?php if (!$is_map): ?>
</div><!-- #main .site-main -->
</div><!-- #primary .primary -->
<?php endif; ?>

<?php if (!$full_width): ?>
  <?php get_sidebar(); ?>
<?php endif; ?>

<?php if (!$is_map): ?>
</div><!-- .table-row -->
<?php endif; ?>
<div id="footer"></div><!-- hack to fix JS -->

</div><!-- .wrapper -->

<footer class="bg-gray">

  <div class="container" role="contentinfo">
    <div class="row">
      <div class="col-md-4 col-sm-12">
        <?php
          if (is_active_sidebar('footer-sidebar-1')) {
              dynamic_sidebar('footer-sidebar-1');
          }
          ?>
      </div>
      <div class="col-md-4 col-sm-12">
        <?php
          if (is_active_sidebar('footer-sidebar-2')) {
              dynamic_sidebar('footer-sidebar-2');
          }
          ?>
      </div>
      <div class="col-md-4 col-sm-12">
        <?php
          if (is_active_sidebar('footer-sidebar-3')) {
              dynamic_sidebar('footer-sidebar-3');
          }
          ?>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="footer-alt">
          <p class="logo">
            <?php
              // if (is_active_sidebar('copyright-sidebar-1')) {
              //     dynamic_sidebar('copyright-sidebar-1');
              // }
              ?>
            <a href="https://www.clir.org/" class="none" target="_blank">
              <span class="clir clir-font clir-color">CLIR</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

  <?php wp_footer(); ?>

</body>
</html>
