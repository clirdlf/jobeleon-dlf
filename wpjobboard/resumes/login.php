<?php
/**
 * Job seeker login page
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */
/* @var $form Wpjb_Form_Resumes_Login */
?>

<div class="where-am-i">
    <h2><?php _e('Candidate login', 'jobeleon'); ?></h2> 
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjr-page-login">

    <?php wpjb_flash() ?>

    <form class="wpjb-form" action="<?php echo wpjr_link_to("login") ?>" method="post">
        <?php echo $form->renderHidden() ?>
        <fieldset class="wpjb-fieldset-x">
            <?php foreach ($form->getReordered() as $group): ?>
                <?php /* @var $group stdClass */ ?> 
                <?php foreach ($group->getReordered() as $name => $field): ?>
                    <?php /* @var $field Daq_Form_Element */ ?>
                    <div class="<?php wpjb_form_input_features($field) ?>">

                        <label class="wpjb-label">
                            <?php esc_html_e($field->getLabel()) ?>
                            <?php if ($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                        </label>

                        <div class="wpjb-field">
                            <?php wpjb_form_render_input($form, $field) ?>
                            <?php wpjb_form_input_hint($field) ?>
                            <?php wpjb_form_input_errors($field) ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>


            <div class="wpjr-submit-login">
                <input type="submit" name="wpjb_login" id="wpjb_submit" value="<?php _e("Login", "jobeleon") ?>" />
                <a href="<?php echo wpjr_link_to("register") ?>"><?php _e("Not a member? Register", "jobeleon") ?></a>
            </div>
        </fieldset>

    </form>

</div>
