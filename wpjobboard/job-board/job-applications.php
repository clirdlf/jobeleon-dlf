<?php
/**
 * Company job applications
 * 
 * Template displays job applications
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $applicantList array List of applications to display */
/* @var $job string Wpjb_Model_Job */
?>

<div class="where-am-i">
    <?php wpjb_breadcrumbs($breadcrumbs) ?>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-job-applications">

    <?php wpjb_flash(); ?>

    <table class="wpjb-table">
        <thead>
            <tr>
                <th><?php _e("Applicant name", "jobeleon") ?></th>
                <th><?php _e("E-mail", "jobeleon") ?></th>
                <th><?php _e("Freshness", "jobeleon") ?></th>
                <th class="wpjb-last"><?php _e("Status", "jobeleon") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($applicantList)) : foreach ($applicantList as $application): ?>
                    <tr class="">
                        <td>
                            <a href="<?php echo wpjb_link_to("job_application", $application) ?>">
                                <?php if ($application->applicant_name): ?>
                                    <?php esc_html_e($application->applicant_name) ?>
                                <?php else: ?>
                                    <?php
                                    _e("ID");
                                    echo ": ";
                                    echo $application->id;
                                    ?>
                                <?php endif; ?>
                            </a><br />
                        </td>
                        <td>
                            <a class="wpjb-mail" href="mailto:<?php esc_attr_e($application->email) ?>"><?php esc_html_e($application->email) ?></a>
                        </td>
                        <td>
                            <?php echo wpjb_time_ago($application->applied_at) ?>
                        </td>
                        <td class="wpjb-last">
                            <?php echo wpjb_application_status($application->status) ?>
                            <div class="company-panel-dropdown" style="display: inline-block">
                                <span id="wpjb-dropdown-<?php echo $application->id ?>-img" class="wpjb-glyphs wpjb-icon-down-open" style="font-size:1.4em; cursor:pointer"></span>
                                <ul id="wpjb-dropdown-<?php echo $application->id ?>" class="wpjb-dropdown">
                                    <?php foreach ($public_ids as $k): ?>
                                        <li><a href="<?php echo wpjb_api_url("action/application", array("id"=>$application->id, "status"=>$k, "redirect_to"=>wpjb_link_to("job_applications", $job))) ?>"><?php esc_html_e(wpjb_application_status($k)) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3" align="center">
                        <?php _e("No applicants found.", "jobeleon"); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


</div>

<script type="text/javascript">
    jQuery(function(){    
        jQuery(".company-panel-dropdown").wpjb_menu({
            position: "right"
        });
    });
</script>
