<?php
/**
 * Company profile page
 * 
 * This template displays company profile page
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $jobList array List of active company job openings */
/* @var $company Wpjb_Model_Company Company information */

$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;
?>

<div id="wpjb-main" class="wpjb-page-company" >

    <?php wpjb_flash() ?>
    <header class="entry-header">
        <h1 class="entry-title author"><?php esc_html_e(Wpjb_Project::getInstance()->title) ?></h1>
    </header>

    <?php if($company->isVisible() || (Wpjb_Model_Company::current() && Wpjb_Model_Company::current()->id == $company->id)): ?>

        <table class="wpjb-info">
            <tbody>
                <?php if ($company->locationToString()): ?>
                    <tr>
                        <td class="wpjb-info-label"><?php _e("Company Location", "jobeleon") ?></td>
                        <td>
                            <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>
                    
                            <?php if(wpjb_conf("show_maps") && $company->getGeo()->status==2): ?>
                            <a href="<?php esc_attr_e(wpjb_google_map_url($company)) ?>" class="wpjb-expand-map"><?php esc_html_e($company->locationToString()) ?></a>
                            <?php else: ?>
                            <?php esc_html_e($company->locationToString()) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                    <?php if (wpjb_conf("show_maps") && $company->getGeo()->status == 2): ?>
                        <tr style="display: table-row;" class="wpjb-expanded-map-row">
                            <td colspan="2" class="wpjb-expanded-map">
                                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($company->company_website): ?>
                    <tr>
                        <td class="wpjb-info-label"><?php _e("Company Website", "jobeleon") ?></td>
                        <td>
                            <span class="wpjb-glyphs wpjb-icon-link jobeleon-darken-color"></span>
                            
                            <?php if($company->doScheme("company_website")): else: ?>
                            <a href="<?php esc_attr_e($company->company_website) ?>" class="wpjb-company-link"><?php esc_html_e($company->company_website) ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach($company->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
                    <tr>
                        <td class="wpjb-info-label"><?php esc_html_e($value->conf("title")); ?></td>
                        <td>
                            <?php if($company->doScheme($k)): else: ?>
                            <?php esc_html_e(join(", ", (array) $value->values())) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php do_action("wpjb_template_company_meta_text", $company) ?>
            </tbody>
        </table>

        <div class="wpjb-job-content">

            <div class="wpjb-job-text">

                <?php if($company->doScheme("company_logo")): ?>
                <?php elseif($company->getLogoUrl()): ?>
                    <div><img src="<?php echo $company->getLogoUrl() ?>" id="wpjb-logo" alt="" /></div>
                <?php endif; ?>

                <?php if($company->doScheme("company_info")): else: ?>
                <?php wpjb_rich_text($company->company_info, $company->meta->company_info_format->value()) ?>
                <?php endif; ?>

            </div>

            <?php foreach($company->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>

                <h3><?php esc_html_e($value->conf("title")); ?></h3>
                <div class="wpjb-job-text">
                    <?php if($company->doScheme($k)): else: ?>
                    <?php wpjb_rich_text($value->value()) ?>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>

            <?php do_action("wpjb_template_job_meta_richtext", $company) ?>

            <h3><?php _e("Current job openings at", "jobeleon") ?> <?php esc_html_e($company->company_name) ?></h3>
            <div class="wpjb-company-openings">
                <ul class="wpjb-company-list">
                    <?php $jobList = wpjb_find_jobs($param) ?>
                    <?php if ($jobList->total > 0): foreach ($jobList->job as $job): ?>
                            <?php /* @var $job Wpjb_Model_Job */ ?>
                            <li class="<?php wpjb_job_features($job); ?>">
                                <?php if ($job->isNew()): ?><span class="wpjb-new-btn btn"><?php _e("New", "jobeleon") ?></span><?php endif; ?>
                                <a href="<?php echo wpjb_link_to("job", $job); ?>"><?php esc_html_e($job->job_title) ?></a>
                                <?php wpjb_time_ago($job->job_created_at, __("posted {time_ago} ago.", "jobeleon")) ?>
                            </li>
                            <?php
                        endforeach;
                    else :
                        ?>
                        <li>
                            <?php _e("Currently this employer doesn't have any openings.", "jobeleon"); ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

    <?php endif; ?>

</div>
