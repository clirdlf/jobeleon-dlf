<?php
/**
 * wpjobboard_theme Theme Customizer
 *
 * @package wpjobboard_theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
// customizer is awesome. period.
function wpjobboard_theme_customize_register($wp_customize) {
    // Default background color
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');

    // Logo upload
    $wp_customize->add_section('wpjobboard_theme_logo_section', array(
        'title' => __('Logo', 'jobeleon'),
        'priority' => 30,
        'description' => 'Upload logo to replace the default site title'
    ));
    $wp_customize->add_setting('wpjobboard_theme_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wpjobboard_theme_logo', array(
                'label' => __('Logo', 'jobeleon'),
                'section' => 'wpjobboard_theme_logo_section',
                'settings' => 'wpjobboard_theme_logo'
            )));

    // color scheme
    $wp_customize->add_section('wpjobboard_theme_color_scheme_section', array(
        'title' => __('Color Scheme', 'jobeleon'),
        'priority' => 34,
        'description' => __('Select your color scheme', 'jobeleon'),
    ));
    $wp_customize->add_setting('wpjobboard_theme_color_scheme', array(
        'default' => 'blue',
    ));
    $wp_customize->add_control(new WPJobboard_Theme_Customize_Colorscheme_Control($wp_customize, 'wpjobboard_theme_color_scheme', array(
                'label' => __('Choose your color scheme', 'jobeleon'),
                'section' => 'wpjobboard_theme_color_scheme_section',
                'default' => 'green',
                'type' => 'radio',
                'choices' => array(
                    'green' => __('Green', 'jobeleon'),
                    'blue' => __('Blue', 'jobeleon'),
                    'mint' => __('Mint', 'jobeleon'),
                    'red' => __('Red', 'jobeleon'),
                ),
                'settings' => 'wpjobboard_theme_color_scheme'
            )));

    // live search
    $wp_customize->add_section('wpjobboard_theme_live_search_section', array(
        'title' => __('Live search', 'jobeleon'),
        'priority' => 28,
        'description' => __('Live search', 'jobeleon'),
    ));
    $wp_customize->add_setting('wpjobboard_theme_live_search', array(
        'default' => 1,
        'sanitize_callback' => 'wpjobboard_theme_live_search_callback'
    ));
    $wp_customize->add_control('wpjobboard_theme_live_search', array(
        'label' => __('Live search', 'jobeleon'),
        'section' => 'wpjobboard_theme_live_search_section',
        'settings' => 'wpjobboard_theme_live_search',
        'type' => 'checkbox',
    ));

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}

add_action('customize_register', 'wpjobboard_theme_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpjobboard_theme_customize_preview_js() {
    wp_enqueue_script('wpjobboard_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130304', true);
}

add_action('customize_preview_init', 'wpjobboard_theme_customize_preview_js');


if (class_exists('WP_Customize_Control')) {

    class WPJobboard_Theme_Customize_Colorscheme_Control extends WP_Customize_Control {

        public $type = 'radio';

        public function render_content() {
            if (empty($this->choices))
                return;

            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php
            foreach ($this->choices as $value => $label) :
                ?>
                <label class="wpjb-colorscheme wpjb-colorscheme-<?php echo esc_attr($value); ?>">
                    <input type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php $this->link();
                checked($this->value(), $value);
                ?> />
                    <span class="wpjb-colorscheme-text"><?php echo esc_html($label); ?></span>
                </label>
                <?php
            endforeach;
        }

    }

}

function wpjobboard_theme_live_search_callback($val) {
    if ($val) {
        update_option('wpjobboard_theme_ls', true);
    } else {
        update_option('wpjobboard_theme_ls', false);
    }
    return $val;
}
