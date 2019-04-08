<?php

/**
* Jobeleon DLF functions and definitions.
*
* When using a child theme you can override certain functions (those wrapped
* in a function_exists() call) by defining them first in your child theme's
* functions.php file. The child theme's functions.php file is included before
* the parent theme's file, so the child theme functions would be used.
*
* @link  https://codex.wordpress.org/Theme_Development
* @link  https://codex.wordpress.org/Child_Themes
*
* Functions that are not pluggable (not wrapped in function_exists()) are
* instead attached to a filter or action hook.
*
* For more information on hooks, actions, and filters,
* {@link https://codex.wordpress.org/Plugin_API}
* @since Jobeleon 1.3
*/

/**
* Add parent style
*/
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    wp_enqueue_style('logocolors', 'https://cdn.rawgit.com/clirdlf/logo-fonts/master/style.min.css');
    wp_enqueue_style('logofonts', 'https://cdn.rawgit.com/clirdlf/logo-fonts/master/clir-font/stylesheet.min.css');
}

/**
* Add JavaScript dependencies
*/
function theme_script_dependencies()
{
    wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/c1ca2c16bc.js');
    wp_enqueue_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js');
    wp_enqueue_script('format-google-calendar', get_stylesheet_directory_uri() . '/js/vendor/format-google-calendar.js');
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.js');
}

/**
* Customize the dlf_wpjb_scheme
*/
function dlf_wpjb_scheme($scheme, $object)
{
    if (isset($object->meta->apply_url)) {
        $scheme["field"]["apply_url"];
        $scheme["field"]["apply_url"]["render_callback"] = "render_as_link";
    }

    if (isset($object->meta->twitter_handle)) {
        $scheme["field"]["twitter_handle"];
        $scheme["field"]["twitter_handle"]["render_callback"] = "render_twitter_link";
    }

    return $scheme;
}

/**
* Filter Twitter handle and render as a link
*/
function render_twitter_link($object)
{
    $url = $object->meta->twitter_handle->value();
    echo sprintf('<i class="wpjb-glyphs fa fa-twitter jobeleon-darken-color" aria-hidden="true"></i> <a target="_blank" href="https://twitter.com/%s">%s</a>', esc_attr($url), esc_html($url));
}

/**
* Render a custom_url as a real URL
*/
function render_as_link($object)
{
    $url = $object->meta->apply_url->value();
    echo sprintf('<i class="wpjb-glyphs fa fa-globe jobeleon-darken-color" aria-hidden="true"></i> <a href="%s" target="_blank">%s</a>', esc_attr($url), esc_html($url));
}

/**
* M, d is a gross format. Rewrite it as M d
* see https://wpjobboard.net/kb/dates-api/
*/
function dlf_wpjb_date_format($param)
{
    if ($param["format"] == "M, d") {
        $param["format"] = "M d";
    }

    return $param;
}

function clir_widgets_init()
{
    register_sidebar(array(
    'name' => 'Footer Sidebar 1',
    'id' => 'footer-sidebar-1',
    'description' => 'Appears in the footer area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ));
    register_sidebar(array(
    'name' => 'Footer Sidebar 2',
    'id' => 'footer-sidebar-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ));
    register_sidebar(array(
    'name' => 'Footer Sidebar 3',
    'id' => 'footer-sidebar-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ));
    register_sidebar(array(
    'name' => 'Footer Sidebar 4',
    'id' => 'footer-sidebar-4',
    'description' => 'Appears in the footer area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ));
    register_sidebar(array(
      'name' => 'Copyright Sidebar',
      'id' => 'copyright-sidebar-1',
      'description' => 'Appears in the copyright area',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '',
      'after_title' => '',
    ));
}

// Actions
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('wp_enqueue_scripts', 'theme_script_dependencies');
add_action('widgets_init', 'clir_widgets_init');

// Filters
add_filter("wpjb_scheme", "dlf_wpjb_scheme", 10, 2);
add_filter("wpjb_date_display", "dlf_wpjb_date_format");
