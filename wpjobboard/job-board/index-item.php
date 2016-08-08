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
/* @var $job Wpjb_Model_Job */
$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;

$random_logo_colors = array('#dbc0e0', '#d7d7d7', '#cde0c0');
?>
<tr class="<?php wpjb_job_features($job); ?>">
    <td class="wpjb-column-logo">
        <?php if($job->doScheme("company_logo")): ?>
        <?php elseif($job->getLogoUrl()): ?>
            <img src="<?php echo $job->getLogoUrl("64x64") ?>" id="wpjb-logo" alt="" />
        <?php else : ?>
            <div class="wpjb-logo-placeholder" style="background-color: <?php echo $random_logo_colors[array_rand($random_logo_colors)]; ?>"></div>
        <?php endif; ?>
    </td>
    <td class="wpjb-column-title">
        <?php if($job->doScheme("job_title")): else: ?>
        <a href="<?php echo wpjb_link_to("job", $job) ?>"><?php esc_html_e($job->job_title) ?></a>
        <?php endif; ?>
        
        <?php if($job->doScheme("company_name")): else: ?>
        <small class="wpjb-sub"><?php esc_html_e($job->company_name) ?></small>
        <?php endif; ?>
    </td>
    <td class="wpjb-column-location">
        <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>
        <?php esc_html_e($job->locationToString()) ?>
        <small class="wpjb-sub">
            <?php if(isset($job->getTag()->type[0])): ?>
            <?php esc_html_e($job->getTag()->type[0]->title) ?>
            <?php else: ?>
            —
            <?php endif; ?>
        </small>
    </td>
    <td class="wpjb-column-date wpjb-last">
        <?php echo wpjb_date_display("M, d", $job->job_created_at, false); ?><br />
        <?php if ($job->isNew()): ?><span class="wpjb-new-btn btn"><?php _e('New', 'jobeleon'); ?></span><?php endif; ?>
    </td>
</tr>
