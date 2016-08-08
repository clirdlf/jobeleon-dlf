<?php
/**
 * Resume part edit page
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */
/* @var $form Wpjb_Form_Resumes_Login */
?>

<div class="where-am-i">
    <?php wpjb_breadcrumbs($breadcrumbs) ?> 
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjr-page-login">

    <?php wpjb_flash() ?>

    <form class="wpjb-form" action="" method="post">
        <?php echo $form->renderHidden() ?>

        <?php foreach ($form->getReordered() as $group): ?>
            <fieldset class="wpjb-fieldset-<?php esc_html_e($group->getName()) ?>">
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
            </fieldset>
        <?php endforeach; ?>

        <fieldset>
            <div>
                <input type="submit" name="wpjb_save" class="wpjb-button" value="<?php _e("Save", "jobeleon") ?>" />
            </div>
        </fieldset>



    </form>


</div>
