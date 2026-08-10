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
    wp_enqueue_style('logocolors', 'https://cdn.rawgit.com/clirdlf/logo-fonts/master/style.min.css');
    wp_enqueue_style('logofonts', 'https://cdn.rawgit.com/clirdlf/logo-fonts/master/clir-font/stylesheet.min.css');
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
    echo sprintf('%s <a target="_blank" href="https://twitter.com/%s">%s</a>', jobeleon_twitter_icon(), esc_attr($url), esc_html($url));
}

/**
* Render a custom_url as a real URL
*/
function render_as_link($object)
{
    $url = $object->meta->apply_url->value();
    echo sprintf('%s <a href="%s" target="_blank">%s</a>', jobeleon_globe_icon(), esc_attr($url), esc_html($url));
}

/**
 * Return the decorative Twitter icon used beside profile links.
 */
function jobeleon_twitter_icon()
{
    return '<svg class="wpjb-glyphs jobeleon-darken-color" aria-hidden="true" focusable="false" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor"><path d="M459.4 151.7c.3 4.5.3 9.1.3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z"/></svg>';
}

/**
 * Return the decorative globe icon used beside external links.
 */
function jobeleon_globe_icon()
{
    return '<svg class="wpjb-glyphs jobeleon-darken-color" aria-hidden="true" focusable="false" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor"><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm234.7-202.6c-20.1 6-39.2 22.3-54.5 48.1-5.8 9.7-11 20.6-15.4 32.5h69.9V53.4zm0 112.6h-79.4c-3.4 20.3-5.3 42.1-5.3 65h84.7v-65zm42.6 0v65H362c0-22.9-1.9-44.7-5.3-65h-79.4zm0-32h69.9c-4.4-11.9-9.6-22.8-15.4-32.5-15.3-25.8-34.4-42.1-54.5-48.1V134zM120.5 134c5.4-17.4 12.5-33.6 21.1-48.1-25.3 16.2-46.5 37.9-62.1 63.1h41zm-55.1 32c-6.3 20.5-9.7 42.3-9.7 65h62.4c0-22.4 1.5-44.2 4.4-65H65.4zm13.9 96c15.6 25.2 36.9 46.9 62.2 63.1-8.6-14.5-15.7-30.7-21.1-48.1h-41.1zm78.1 15c4.4 11.9 9.6 22.8 15.4 32.5 15.3 25.8 34.4 42.1 54.5 48.1V277h-69.9zm-5.3-32h75.2v-14h-75.6c0 4.7.1 9.4.4 14zm117.2 112.6c20.1-6 39.2-22.3 54.5-48.1 5.8-9.7 11-20.6 15.4-32.5h-69.9v80.6zm0-112.6h75.2c.3-4.6.4-9.3.4-14h-75.6v14zm122.3 32c-5.4 17.4-12.5 33.6-21.1 48.1 25.3-16.2 46.6-37.9 62.2-63.1h-41.1zm55.1-32c.3-4.6.4-9.3.4-14 0-22.7-3.4-44.5-9.7-65h-57.1c2.9 20.8 4.4 42.6 4.4 65 0 4.7-.1 9.4-.3 14h62.3zM432.5 149c-15.6-25.2-36.8-46.9-62.1-63.1 8.6 14.5 15.7 30.7 21.1 48.1h41z"/></svg>';
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
  //   register_sidebar(array(
  //   'name' => 'Footer Sidebar 4',
  //   'id' => 'footer-sidebar-4',
  //   'description' => 'Appears in the footer area',
  //   'before_widget' => '',
  //   'after_widget' => '',
  //   'before_title' => '<h5>',
  //   'after_title' => '</h5>',
  // ));
    // register_sidebar(array(
    //   'name' => 'Copyright Sidebar',
    //   'id' => 'copyright-sidebar-1',
    //   'description' => 'Appears in the copyright area',
    //   'before_widget' => '',
    //   'after_widget' => '',
    //   'before_title' => '',
    //   'after_title' => '',
    // ));
}

// Actions
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('widgets_init', 'clir_widgets_init');

// Filters
add_filter("wpjb_scheme", "dlf_wpjb_scheme", 10, 2);
add_filter("wpjb_date_display", "dlf_wpjb_date_format");
