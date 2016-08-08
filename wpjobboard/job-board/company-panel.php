<?php
/**
 * Company job stats
 * 
 * Template displays company jobs stats
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $jobList array List of jobs to display */
/* @var $browse string One of: active; expired */
/* @var $routerIndex string */
/* @var $expiredCount int Total number of company expired jobs */
/* @var $activeCount int Total number of company active jobs */
?>

<div class="where-am-i">
    <?php wpjb_breadcrumbs($breadcrumbs) ?>
</div><!-- .where-am-i -->

<ul class="wpjb-tabs wpjb-page-company-panel">
    <li class="wpjb-tab-link <?php if($browse == "active"):?>current<?php endif; ?>">
        <a href="<?php echo wpjb_link_to("employer_panel") ?>"><?php _e("Active", "jobeleon"); ?></a> (<?php echo $total->active ?>)
    </li>
    <li class="wpjb-tab-link <?php if($browse == "pending"):?>current<?php endif; ?>">
        <a href="<?php echo wpjb_link_to("employer_panel", null, array("filter"=>"pending")) ?>"><?php _e("Pending", "jobeleon"); ?></a> (<?php echo $total->pending ?>)
    </li>
    <li class="wpjb-tab-link <?php if($browse == "expired"):?>current<?php endif; ?>">
        <a href="<?php echo wpjb_link_to("employer_panel", null, array("filter"=>"expired")) ?>"><?php _e("Expired", "jobeleon"); ?></a> (<?php echo $total->expired ?>)
    </li>
</ul>

<div id="wpjb-main" class="wpjb-page-company-panel">

    <?php wpjb_flash(); ?>



    <table class="wpjb-table">
        <thead>
            <tr>
                <th class="wpjb-column-expires"><?php _e("Expires", "jobeleon") ?></th>
                <th class="wpjb-title"><?php _e("Title", "jobeleon") ?></th>
                <th><?php _e("Applications", "jobeleon") ?></th>
                <th class="wpjb-last">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jobList)): foreach ($jobList as $job): ?>
                    <tr class="<?php
            wpjb_job_features($job);
            wpjb_panel_features($job)
                    ?>">
                        <td class="wpjb-column-expires">
                            <?php if ($job->job_expires_at === WPJB_MAX_DATE): ?>
                                <?php _e("Never", "jobeleon") ?>
                            <?php elseif ($job->expired()): ?>
                                <?php _e("Expired", "jobeleon") ?>
                            <?php else: ?>
                                <?php esc_html_e(wpjb_date_display(get_option("date_format"), $job->job_expires_at)) ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo wpjb_link_to("job_edit", $job); ?>"><?php esc_html_e($job->job_title) ?></a>
                        </td>
                        <td class="wpjb-statistics">
                            <a href="<?php echo wpjb_link_to("job_applications", $job) ?>">
                                <?php $applications = Wpjb_Model_Application::search(array("job"=>$job->id, "count_only"=>true, "filter"=>"public")) ?>
                                <?php if($applications) : ?>
                                    <?php printf( _n("1 application", "%d applications", $applications, "jobeleon"), $applications ) ?>
                                <?php else: ?>
                                    <?php _e("0 applications", "jobeleon") ?>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td class="wpjb-last">
                            <div class="company-panel-dropdown">
                                <span id="wpjb-dropdown-<?php echo $job->id ?>-img" class="wpjb-glyphs wpjb-icon-down-open" style="font-size:1.4em; cursor:pointer"></span> 
                                <ul id="wpjb-dropdown-<?php echo $job->id ?>" class="wpjb-dropdown">
                                    <li><a href="<?php echo wpjb_link_to("job", $job) ?>"><?php _e("View job", "jobeleon") ?></a></li>
                                    <li><a href="<?php echo wpjb_link_to("job_edit", $job); ?>"><?php _e("Edit job", "jobeleon") ?></a></li>
                                    <li><a href="<?php echo wpjb_link_to("step_add", null, array("republish"=>$job->id)) ?>"><?php _e("Republish", "jobeleon") ?></a></li>
                                    <?php if($browse == "pending" && in_array(Wpjb_Model_Job::STATUS_PAYMENT, $job->status())): ?>
                                    <li><a href="<?php echo $job->paymentUrl() ?>"><?php _e("Make Payment ...", "jobeleon") ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo wpjb_link_to("job_applications", $job) ?>"><?php _e("Applicants", "jobeleon") ?></a></li>
                                    <li><a href="<?php echo wpjb_link_to("job_delete", $job) ?>"><?php _e("Delete ...", "jobeleon") ?></a></li>
                                    <?php if($job->is_filled): ?>
                                    <li><a href="<?php echo wpjb_api_url("action/job", array("id"=>$job->id, "do"=>"unfill", "redirect_to"=>$url)) ?>"><?php _e("Mark as not filled", "jobeleon") ?></a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo wpjb_api_url("action/job", array("id"=>$job->id, "do"=>"fill", "redirect_to"=>$url)) ?>"><?php _e("Mark as filled", "jobeleon") ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="4" align="center">
                        <?php _e("No job listings found.", "jobeleon"); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page) ?>
    </div>


</div>

<script type="text/javascript">

    // 
    jQuery(function(){   
        
        jQuery(".company-panel-dropdown").wpjb_menu({
            position: "right"
        });
    });

</script>
