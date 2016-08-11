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
<div id="footer"></div><!-- hack to fix JS -->

</div><!-- .wrapper -->

<footer class="bg-gray">

<div class="container" role="contentinfo">
<div class="row">
  <div class="col-md-3 col-sm-6">
    <h5>Contact</h5>
    <address>
      CLIR+DLF<br>
      1707 L St. NW,<br>
      Suite 650<br/>
      Washington, DC 20036<br>
      <abbr title="Phone">P:</abbr> (202) 939-4750<br>
      <abbr title="Email">E:</abbr> <a href="mailto:jobs(at)diglib(dot)org">jobs at diglib dot org</a>
    </address>
  </div>

  <div class="col-md-3 col-sm-6">
    <h5>Elsewhere</h5>
      <ul class="list-unstyled">
        <li><a href="https://twitter.com/CLIRDLF"><i class="fa fa-twitter twitter"></i> @CLIRDLF</a></li>
        <li><a href="https://www.diglib.org/"><i class="fa fa-rss rss"></i> Blog</a></li>
        <li><a href="https://www.linkedin.com/groups/3387265/profile"><i class="fa fa-linkedin linkedin"></i> LinkedIn</a></li>
				<li><a href="https://diglib.org/announce/"><i class="fa fa-envelope envelope"></i> DLF-Announce</a></li>
      </ul>
  </div>

  <div class="col-md-3 col-sm-6">
    <h5>From the Calendar</h5>
    <div id="calendar">
      <ul class="list-unstyled" id="upcoming-events"></ul>
    </div>
    <p>See more <a href="http://digital-conferences-calendar.info">DLF Community Calendar</a> events.</p>
  </div>

  <div class="col-md-3 col-sm-6">
    <p class="logo">What's the DLF?</p>
    <p>We are networked member institutions and a robust community of practice—<em>advancing research, learning, social justice, &amp; the public good</em> through digital library technologies.</br><a href="https://www.diglib.org/members/join/" class="btn btn-default btn-info">Join us!</a></p>
  </div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="footer-alt">
        <p class="pull-right">&nbsp;</p>
        <p class="logo">
          <a href="https://diglib.org"><i class="icon-dlf-logo blue"></i> <span class="dlf">DLF</span></a>
        </p>
      </div>
    </div>
  </div>
</div>
</footer>

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9461551-4', 'auto');
  ga('send', 'pageview');

  jQuery(document).ready(function(){
    jQuery('a[href^="mailto:"]').each(function() {
      this.href = this.href.replace('(at)', '@').replace(/\(dot\)/g, '.');
      this.innerHTML = this.href.replace('mailto:', '');
    });
  });
</script>

</body>
</html>
