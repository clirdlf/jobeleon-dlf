<?php

/**
 * Jobeleon DLF functions and definitions.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 * @since Jobeleon 1.3
 */

function theme_enqueue_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

function theme_script_dependencies()
{
  wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/c1ca2c16bc.js');
  wp_enqueue_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js');
  wp_enqueue_script('format-google-calendar',  get_stylesheet_directory_uri() . '/js/vendor/format-google-calendar.js');
  wp_enqueue_script('main',  get_stylesheet_directory_uri() . '/js/main.js');
}

function dlf_wpjb_scheme($scheme, $object)
{
    if (isset($object->meta->custom_url)) {
        $scheme["field"]["custom_url"]["render_callback"] = "my_render_as_link";
    }

    return $scheme;
}

/**
 * Render a custom_url as a real URL
 */
function render_as_link($object)
{
    $url = $object->meta->custom_url->value();
    echo sprintf('<a href="%s" target="_blank">%s</a>', esc_attr($url), esc_html($url));
}


// Actions
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('wp_enqueue_scripts', 'theme_script_dependencies');

// Filters
add_filter("wpjb_scheme", "dlf_wpjb_scheme", 10, 2);

