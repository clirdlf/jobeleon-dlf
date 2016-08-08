<?php
/**
 * Job application details
 *
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
  /* @var $job Wpjb_Model_Job */
/* @var $application Wpjb_Model_Application */
?>

<div class="where-am-i">
    <?php wpjb_breadcrumbs($breadcrumbs) ?>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-job-application">

    <?php wpjb_flash(); ?>

    <table class="wpjb-info">
        <tbody>
            <tr>
                <td><?php _e("Application Status", "jobeleon") ?></td>
                <td>
                    <form action="" method="post">
                        <select name="status">
                            <?php foreach ($public_ids as $k): ?>
                                <option value="<?php esc_html_e($k) ?>" <?php if ($k == $application->status): ?>selected="selected"<?php endif; ?>><?php esc_html_e(wpjb_application_status($k)) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="<?php _e("change", "jobeleon") ?>" />
                    </form>
                </td>
            </tr>
            <?php if($application->user_id && is_array(wpjb_conf("cv_show_applicant_resume"))): ?>
            <tr>
                <td><?php _e("Applicant Resume", "jobeleon") ?></td>
                <td><a href="<?php esc_attr_e(wpjr_link_to("resume", $application->getResume(), array("application_id"=>$application->id))) ?>"><?php _e("View Resume", "jobeleon") ?></a></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td><?php _e("Applicant Name", "jobeleon") ?></td>
                <td><?php echo $application->applicant_name ?></td>
            </tr>
            <tr>
                <td><?php _e("Applicant E-mail", "jobeleon") ?></td>
                <td><?php echo $application->email ?></td>
            </tr>
            <tr>
                <td><?php _e("Date Sent", "jobeleon") ?></td>
                <td><?php echo wpjb_date_display(get_option("date_format"), $application->applied_at) ?></td>
            </tr>
            <?php foreach($application->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
                <tr>
                    <td class="wpjb-info-label"><?php esc_html_e($value->conf("title")); ?></td>
                    <td><?php esc_html_e(join(", ", (array) $value->values())) ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if (count($application->getFiles())): ?>
                <tr>
                    <td><?php _e("Attached Files", "jobeleon") ?></td>
                    <td>
                        <?php foreach ($application->getFiles() as $file): ?>
                            <a href="<?php echo esc_attr($file->url) ?>"><?php echo esc_html($file->basename) ?></a>
                            ~ <?php echo esc_html(wpjb_format_bytes($file->size)) ?>
                            <br/>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="wpjb-job-content">
        <h3><?php _e("Message", "jobeleon") ?></h3>
        <div class="wpjb-job-text">
            <?php echo wpjb_rich_text($application->message) ?>
        </div>

        <?php foreach($application->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>

            <h3><?php esc_html_e($value->conf("title")); ?></h3>
            <div class="wpjb-job-text">
                <?php wpjb_rich_text($value->value()) ?>
            </div>

        <?php endforeach; ?>
    </div>

</div>
