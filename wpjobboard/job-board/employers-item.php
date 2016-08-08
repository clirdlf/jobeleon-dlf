<?php 

/**
 * Job list item
 * 
 * This template is responsible for displaying job list item on job list page
 * (template index.php) it is alos used in live search
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $company Wpjb_Model_Company */

$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;

$random_logo_colors = array('#dbc0e0', '#d7d7d7', '#cde0c0');

?>

<tr class="">
    <td class="wpjb-column-logo">
        <?php if($company->doScheme("company_logo")): ?>
        <?php elseif($company->getLogoUrl()): ?>
            <img src="<?php echo $company->getLogoUrl("64x64") ?>" id="wpjb-logo" alt="" />
        <?php else : ?>
            <div class="wpjb-logo-placeholder" style="background-color: <?php echo $random_logo_colors[array_rand($random_logo_colors)]; ?>"></div>
        <?php endif; ?>
    </td>
    <td class="wpjb-column-title">
        <a href="<?php echo wpjb_link_to("company", $company) ?>"><?php esc_html_e($company->company_name) ?></a>
        <span class="wpjb-sub"><?php esc_html_e(sprintf(__("Posted Jobs: %d", "jobeleon"), $company->jobs_posted)) ?></span>
    </td>
    <td class="wpjb-column-location">
        <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>
        <?php esc_html_e($company->locationToString()) ?>
    </td>
    <td class="wpjb-column-date wpjb-last">
        <?php echo wpjb_date_display("M, d", $company->getUser(true)->user_registered, false); ?>
    </td>
</tr>


