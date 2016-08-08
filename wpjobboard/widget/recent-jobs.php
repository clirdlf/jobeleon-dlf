<?php
/**
 * Recently posted jobs
 * 
 * Recent jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */
/* @var $jobList array List of Wpjb_Model_Job objects */
?>

<?php echo $theme->before_widget ?>
<?php if ($title) echo $theme->before_title . $title . $theme->after_title ?>

<ul>
    <?php if(!empty($jobs->job)): foreach($jobs->job as $job): ?>
            <li><a href="<?php echo wpjb_link_to("job", $job) ?>">
                    <h4 class="job-title"><?php esc_html_e($job->job_title) ?></h4>
                    <span class="job-company"><?php esc_html_e($job->company_name) ?></span>
                    <span class="job-location"><?php esc_html_e($job->locationToString()); ?></span>
                </a></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php _e("No job listings found.", "jobeleon") ?></li>
    <?php endif; ?>
</ul>
<a href="<?php echo wpjb_url() ?>" class="view-all">
    <?php _e("view all &raquo;", "jobeleon") ?>
</a>

<?php echo $theme->after_widget ?>
