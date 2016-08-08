<?php
/**
 * Apply for a job form
 * 
 * Displays form that allows to apply for a selected job
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
?>

<div class="where-am-i">
    <h2><?php _e('Company verify', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-employer-verify">

    <?php wpjb_flash(); ?>

    <?php if (!$hide_form): ?>
        <div>
            <?php _e("Clicking 'request verification' button will start manual verification proccess. Site Administrator might contact you and request some additional company information.", "jobeleon") ?>
        </div>

        <br class="wpjb-clear" />

        <form action="" method="post" class="wpjb-form">
            <input type="hidden" name="verify_me" value="1" />

            <input type="submit" class="wpjb-submit" id="wpjb_submit" value="<?php _e("Request verification", "jobeleon") ?>" />
            <?php _e("or", "jobeleon"); ?>
            <a href="javascript:history.back()"><?php _e("Cancel and go back", "jobeleon") ?></a>
        </form>
    <?php else: ?>
        <a class="wpjb-button wpjb-cancel" href="<?php esc_html_e(wpjr_link_to("home")) ?>"><?php _e("Go back.", "jobeleon") ?></a>
    <?php endif; ?>

</div>
