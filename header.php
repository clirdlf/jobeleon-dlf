<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package wpjobboard_theme
 * @since wpjobboard_theme 1.0
 */

$is_map = basename( get_page_template() ) == "home-map.php";

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <!--[if lt IE 9]>
                <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/stylesheets/ie8.css' type='text/css' media='all' />
                <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->

        <?php wp_head(); ?>

    </head>
    
    <body <?php body_class(); ?>>
        <?php $is_wpjb = ( jobeleon_is_wpjb() ) ? 'wpjb' : ''; ?>
        <div class="wrapper <?php echo $is_wpjb ?>">
            <header id="header" role="banner" class="table-row site-header">
                <div class="primary">
                    <div class="table-wrapper">
                        <h1 class="site-title">
                            <?php if (get_theme_mod('wpjobboard_theme_logo')) : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_theme_mod('wpjobboard_theme_logo'); ?>" alt="<?php bloginfo('name'); ?> logo" class="logo" /></a>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            <?php endif; ?>
                        </h1>

                        <nav role="navigation" id="site-navigation" class="site-navigation main-navigation">
                            <h1 class="assistive-text"><?php _e('Menu', 'jobeleon'); ?></h1>
                            <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e('Skip to content', 'jobeleon'); ?>"><?php _e('Skip to content', 'jobeleon'); ?></a></div>

                            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                        </nav><!-- .site-navigation .main-navigation -->
                    </div><!-- .table-wrapper -->
                </div><!-- .primary -->
                <div class="secondary" <?php if($is_map): ?>style="background:white"<?php endif; ?>>
                    <div class="button-group header-buttons">
                        <!-- watch out, don't line break -->
                        <?php if (function_exists('wpjb_link_to')) : ?>
                            <a href="<?php echo wpjb_link_to("step_add", null, array(), wpjb_conf("urls_link_job_add")) ?>" class="btn"><?php _e("Post a job", "jobeleon") ?></a><a href="<?php
                        echo
                        wpjb_link_to("advsearch")
                            ?>" class="btn"><?php _e("Find a job", "jobeleon") ?></a>
<?php endif; ?>
                    </div><!-- .main-job-buttons -->
                </div><!-- .secondary -->
            </header><!-- #header .site-header -->
            
            <?php if(!$is_map): ?>
            <div class="table-row">
                <div id="primary" class="primary">
                    <div id="main" class="site-main">
            <?php endif; ?>
