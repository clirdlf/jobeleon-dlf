<?php
/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $job Wpjb_Model_Job */
/* @var $company Wpjb_Model_Employer */
$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;
?>

<?php $job = wpjb_view("job") ?>

<div itemscope itemtype="http://schema.org/JobPosting">
<meta itemprop="title" content="<?php esc_attr_e($job->job_title) ?>" />
<meta itemprop="datePosted" content="<?php esc_attr_e($job->job_created_at) ?>" />

<table class="wpjb-info">
    <tbody>
        <?php if ($job->company_name): ?>
            <tr>
                <td class="wpjb-info-label wpjb-company-name">
                    <?php if($job->doScheme("company_name")): else: ?>
                    <?php _e("at", "jobeleon") ?>                     
                    
                    <span itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
                        <span itemprop="name" class="author">
                            <?php wpjb_job_company($job) ?>
                        </span>
                    </span>
                    <?php wpjb_job_company_profile($job->getCompany(true)) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($job->locationToString()): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Location", "jobeleon") ?></td>
                <td>
                    <span itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
                        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <meta itemprop="addressLocality" content="<?php esc_attr_e($job->job_city) ?>" /> 
                            <meta itemprop="addressRegion" content="<?php esc_attr_e($job->job_state) ?>" />
                            <meta itemprop="addressCountry" content="<?php $country = Wpjb_List_Country::getByCode($job->job_country); esc_attr_e($country["iso2"]) ?>" />
                            <meta itemprop="postalCode" content="<?php esc_attr_e($job->job_zip_code) ?>" />
   
                            <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>
                    
                            <?php if(wpjb_conf("show_maps") && $job->getGeo()->status==2): ?>
                            <a href="<?php esc_attr_e(wpjb_google_map_url($job)) ?>" class="wpjb-expand-map"><?php esc_html_e($job->locationToString()) ?></a>
                            <?php else: ?>
                            <?php esc_html_e($job->locationToString()) ?>
                            <?php endif; ?>
                    
                        </span>
                    </span>
                </td>
            </tr>
            <?php if (wpjb_conf("show_maps") && $job->getGeo()->status == 2): ?>
                <tr style="display: table-row;" class="wpjb-expanded-map-row">
                    <td colspan="2" class="wpjb-expanded-map">
                        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>
        <tr>
            <td class="wpjb-info-label"><?php _e("Date Posted", "jobeleon") ?></td>
            <td>
                <span class="wpjb-glyphs wpjb-icon-calendar jobeleon-darken-color updated published"></span>
                <?php echo wpjb_job_created_at(get_option('date_format'), $job) ?>
            </td>
        </tr>
        <?php if (!empty($job->getTag()->category)): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Category", "jobeleon") ?></td>
                <td>
                    <span class="wpjb-glyphs wpjb-icon-tags jobeleon-darken-color"></span>
                    <?php foreach ($job->getTag()->category as $category): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("category", $category)) ?>">
                        <span itemprop="occupationalCategory"><?php esc_html_e($category->title) ?></span>
                    </a>
                    <br/>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endif ?>
        <?php if (!empty($job->getTag()->type)): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Job Type", "jobeleon") ?></td>
                <td>
                    <span class="wpjb-glyphs wpjb-icon-tags jobeleon-darken-color"></span>
                    <?php foreach ($job->getTag()->type as $type): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("type", $type)) ?>">
                        <span itemprop="employmentType"><?php esc_html_e($type->title) ?></span>
                    </a>
                    <br/>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php foreach($job->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
            <tr>
                <td class="wpjb-info-label"><?php esc_html_e($value->conf("title")); ?></td>
                <td>
                    <?php if($job->doScheme($k)): ?>
                    <?php elseif($value->conf("type") == "ui-input-file"): ?>
                        <?php foreach($job->file->{$value->name} as $file): ?>
                        <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                        <?php echo wpjb_format_bytes($file->size) ?><br/>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php esc_html_e(join(", ", (array)$value->values())) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php do_action("wpjb_template_job_meta_text", $job) ?>
    </tbody>
</table>

<div class="wpjb-job-content">

    <h3><?php _e("Description", "jobeleon") ?></h3>
    <div itemprop="description" class="wpjb-job-text">

        <?php if($job->doScheme("company_logo")): ?>
        <?php elseif($job->getLogoUrl()): ?>
            <div><img src="<?php echo $job->getLogoUrl() ?>" id="wpjb-logo" alt="" /></div>
        <?php endif; ?>

        <?php if($job->doScheme("job_description")): else: ?>
        <?php wpjb_rich_text($job->job_description, $job->meta->job_description_format->value()) ?>
        <?php endif; ?>

    </div>

    <?php foreach($job->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>

        <h3><?php esc_html_e($value->conf("title")); ?></h3>
        <div class="wpjb-job-text">
            <?php if($job->doScheme($k)): else: ?>
            <?php wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text") ?>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

    <?php do_action("wpjb_template_job_meta_richtext", $job) ?>
</div>

</div>