<?php

/**
 * wpjobboard_theme functions and definitions
 *
 * @package wpjobboard_theme
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if (!function_exists('wpjobboard_theme_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function wpjobboard_theme_setup() {

        /**
         * Custom template tags for this theme.
         */
        require( get_template_directory() . '/inc/template-tags.php' );

        /**
         * Custom functions that act independently of the theme templates
         */
        require( get_template_directory() . '/inc/extras.php' );

        /**
         * Customizer additions
         */
        require( get_template_directory() . '/inc/customizer.php' );

        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on wpjobboard_theme, use a find and replace
         * to change 'jobeleon' to the name of your theme in all the template files
         */
        load_theme_textdomain('jobeleon', get_template_directory() . '/languages');
        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support('automatic-feed-links');

        /**
         * Enable support for Post Thumbnails
         */
        add_theme_support('post-thumbnails');

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'jobeleon'),
            'footer' => __('Footer', 'jobeleon')
        ));

        /**
         * Enable support for Post Formats
         */
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
    }

endif; // wpjobboard_theme_setup
add_action('after_setup_theme', 'wpjobboard_theme_setup');

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function wpjobboard_theme_register_custom_background() {
    $args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
    );

    $args = apply_filters('wpjobboard_theme_custom_background_args', $args);

    if (function_exists('wp_get_theme')) {
        add_theme_support('custom-background', $args);
    } else {
        define('BACKGROUND_COLOR', $args['default-color']);
        if (!empty($args['default-image']))
            define('BACKGROUND_IMAGE', $args['default-image']);
        add_custom_background();
    }
}

add_action('after_setup_theme', 'wpjobboard_theme_register_custom_background');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function wpjobboard_theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'jobeleon'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'wpjobboard_theme_widgets_init');

/**
 * Enqueue scripts and styles
 */
function wpjobboard_theme_scripts() {
    
    //if(is_wpjb() && wpjb_is_routed_to("index.index")) wp_dequeue_script( 'wpjb-js' );
    wp_dequeue_style( 'wpjb-css' );
    wp_enqueue_style( 'wpjb-glyphs' );
    
    wp_enqueue_style('wpjobboard_theme-style', get_stylesheet_uri());

    wp_enqueue_script('wpjobboard_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);

    wp_enqueue_script('wpjobboard_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('wpjobboard_theme-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20120202');
    }

    // add input placeholder for... y'know... stuff...
    wp_enqueue_script('wpjobboard_theme_placeholder', get_template_directory_uri() . '/js/jquery-placeholder/jquery.placeholder.min.js', array('jquery'), '20130105');

    wp_enqueue_script('wpjobboard_theme_customSelect', get_template_directory_uri() . '/js/jquery.customSelect.min.js', array('jquery'), '20130905');

    wp_enqueue_script('wpjobboard_theme_scripts', get_template_directory_uri() . '/js/wpjobboard_theme_scripts.js', array('jquery'), '20130427');

    if (get_option("wpjobboard_theme_ls") && function_exists("is_wpjb") && (is_wpjb() || is_wpjr())) {
        wp_enqueue_script('wpjobboard_theme_live_search', get_template_directory_uri() . '/js/wpjobboard_theme_live_search.js', array('jquery'));
        wp_localize_script('wpjobboard_theme_live_search', 'WpjbLiveSearchLocale', array(
            "no_jobs_found" => __('No job listings found', 'jobeleon'),
            "no_resumes_found" => __('No resumes found', 'jobeleon'),
            "load_x_more" => __('Load %d more', 'jobeleon')
        ));
    }
}

add_action('wp_enqueue_scripts', 'wpjobboard_theme_scripts', 30);

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );
// we need to set default background color not for customizer but the subpage in appearance
add_theme_support('custom-background', array('default-color' => 'eff0f2'));

if (!function_exists('logme')) {

    function logme($message) {
        if (WP_DEBUG === true) {
            if (is_array($message) || is_object($message)) {
                error_log(print_r($message, true));
            } else {
                error_log($message);
            }
        }
    }

}
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

add_action('wp_print_styles', 'wpjobboard_theme_deregister', 100);

function wpjobboard_theme_deregister() {
    wp_deregister_style('wpjb-css');
}

function wpjobboard_theme_render_step($num, $mark = "<strong>&raquo; {text}</strong>") {
    $steps = array(
        array(esc_html(Wpjb_Project::getInstance()->conf("seo_step_1")), __("Create ad", "jobeleon")),
        array(esc_html(Wpjb_Project::getInstance()->conf("seo_step_2")), __("Preview", "jobeleon")),
        array(esc_html(Wpjb_Project::getInstance()->conf("seo_step_3")), __("Done!", "jobeleon"))
    );

    $current = $steps[($num - 1)];
    if (strlen($current[0]) == 0) {
        $current = $current[1];
    } else {
        $current = $current[0];
    }

    $currentStep = wpjb_view("current_step");

    if ($currentStep == $num) {
        $title = str_replace("{text}", $current, $mark);
        echo '<li class="wpjb-current-step">';
        echo $num . '. ' . $title;
        echo '</li>';
        Wpjb_Project::getInstance()->title = $current;
    } else {
        echo '<li ' . ( $num < $currentStep ? 'class="wpjb-begone-step"' : '' ) . '>';
        echo $num . '. ' . $current;
        echo '</li>';
    }
}

function wpjobboard_theme_block_resume_details() {
    $basedir = basename(Wpjb_Project::getInstance()->getBaseDir());

    $suffix = 'green'; // color scheme
    $color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
    $suffix = !empty($color_scheme) ? $color_scheme : $suffix;

    $img = new Daq_Helper_Html("span", array(
        "class" => "wpjb-glyphs wpjb-icon-lock jobeleon-darken-color",
        "style" => "margin-left:0px"
    ));
    $img->forceLongClosing(true);

    $m = $img->render() . " ";
    $m .= '<i>' . __("Locked", 'jobeleon') . '</i>';

    return $m;
}

function wpjobboard_theme_admin_style() {
    wp_enqueue_style('wpjobboard_theme_admin_style', get_template_directory_uri() . '/stylesheets/admin.css');
}

add_action('admin_init', 'wpjobboard_theme_admin_style');

function wpjobboard_theme_color_scheme() {

    $img_directory = get_template_directory_uri() . '/stylesheets/img/';

    $color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
    // default
    if ('green' == $color_scheme) {
        return;
    }
    switch ($color_scheme) {
        case 'blue':
            $normal_color = '#5cace2';
            $darken_color = '#59a7db';
            $lighten_color = '#5eb2ea';
            break;
        case 'mint':
            $normal_color = '#3abd8f';
            $darken_color = '#38b78b';
            $lighten_color = '#40ce9c';
            break;
        case 'red':
            $normal_color = '#e74c3c';
            $darken_color = '#e04a3a';
            $lighten_color = '#f05748';
            break;
        default: return;
    }
    
    extract( apply_filters('jobeleon_color_scheme', compact( $normal_color, $darken_color ) ) );
    
// map tooltip setting is on job.php
    echo '<style>';
    echo "
.jobeleon-normal-color {
    color: $normal_color;
}
.jobeleon-normal-bg, .noUi-connect {
    background-color: $normal_color;
}
.jobeleon-normal-border {
    border-color: $normal_color;
}
.jobeleon-darken-color {
    color: $darken_color;
}
.jobeleon-darken-bg {
    background-color: $darken_color;
}
.jobeleon-darken-border {
    border-color: $darken_color;
}


::selection {
        background: $normal_color;
}
::-moz-selection {
        background: $normal_color;
}
a,
.widget li a:hover,
.wpjb-element-input-radio .wpjb-field,
.widget .recentcomments a,
.comment-list .edit-link a        {
        color: $normal_color;
}
.btn,
.widget input[type=\"submit\"],
body:after,
input[type=\"submit\"],
input[type=\"reset\"],
button,
.wpjb-button,
#wpjb-step .wpjb-current-step:before,
#wpjb-step .wpjb-begone-step:before,
.wpjb-filters .wpjb-sub-filters,
.wpjb-filters .wpjb-top-filter > a,
#wpjb-step:after,
.page-numbers a,
.comment-list .reply a,
#wpjb-paginate-links .page-numbers,
.customSelectInner:after, 
.wpjb-new-btn:hover,
.wpjb-dropdown
{
        background-color: $normal_color;
}
.btn:hover,
.widget input[type=\"submit\"]:hover,
input[type=\"submit\"]:hover,
input[type=\"reset\"]:hover,
button:hover,
.wpjb-button:hover,
.page-numbers a:hover,
.comment-list .reply a:hover,
#wpjb-paginate-links .page-numbers:hover
{
        background-color: $darken_color;
}
.wpjb-element-input-radio .wpjb-field input:checked
{
        border-color: $normal_color;
}
.wpjb-filters .wpjb-top-filter > a:after {
        border-left-color: $normal_color;
}
.wpjb-box { background-color: $normal_color; }
.wpjb-box:hover { background-color: $darken_color; }
.wpjb .blue span { background-color: $normal_color; }
";
    echo '</style>';
}

add_action('wp_head', 'wpjobboard_theme_color_scheme');


// 4.3 functions

global $wpjobboard;

function jobeleon_is_wpjb($content = null) {
    global $post;
    
    if($content == null && $post) {
        $content = $post->post_content;
    }
    
    if(!function_exists("is_wpjb")) {
        return false;
    }
    
    if(is_wpjb() || is_wpjr()) {
        return true;
    }
    
    $valid = array("wpjb_alerts", "wpjb_apply_form", "wpjb_jobs_add", "wpjb_jobs_list", "wpjb_jobs_search", "wpjb_employer_panel",
        "wpjb_employers_list", "wpjb_employers_search", "wpjb_resumes_list", "wpjb_resumes_search", "wpjb_employer_register",
        "wpjb_candidate_register", "wpjb_candidate_panel"
    );
    foreach($valid as $sh) {
        if(has_shortcode($content, $sh)) {
            return true;
        }
    }
    
    return false;
}

add_action("init", "jobeleon_init");
function jobeleon_init() {
        
    wp_register_style( 'jobeleon-nouislider', get_template_directory_uri()."/stylesheets/jquery.nouislider.min.css" );
    wp_register_style( 'jobeleon-nouislider-pips', get_template_directory_uri()."/stylesheets/jquery.nouislider.pips.min.css" );
    
    wp_register_script( 'jobeleon-nouislider', get_template_directory_uri().'/js/jquery.nouislider.all.js', array("jquery"));
    
    
}

if(is_admin()) {
   include_once dirname(__FILE__) . '/inc/admin-pages.php'; 
}