<div class="where-am-i">
    <h2><?php _e('Add job', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-preview wpjb">

    <?php wpjb_flash(); ?>

    <?php if (wpjb_user_can_post_job()): ?>
        <?php wpjb_add_job_steps(); ?>
        <h2 class="wpjb-job-title"><?php esc_html_e($job->job_title) ?></h2>
        <?php wpjb_job_template(); ?>

        <div style="text-align:center">
            <h3>
                <a href="<?php echo wpjb_link_to("step_add") ?>" class="wpjb-go-back">&#171; <?php _e("Edit Listing", "jobeleon") ?></a>
                <a href="<?php echo wpjb_link_to("step_save"); ?>" class="wpjb-go-publish btn"><?php _e("Publish Listing", "jobeleon") ?></a>
            </h3>
        </div>
    <?php endif; ?>

</div>
