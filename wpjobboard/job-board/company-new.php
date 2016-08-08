 
<div class="where-am-i">
    <h2><?php _e('Employer registration', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-company-new">

    <?php wpjb_flash() ?>

    <form action="" method="post" id="wpjb-resume" class="wpjb-form" enctype="multipart/form-data">

        <?php echo $form->renderHidden() ?>
        <?php foreach ($form->getReordered() as $group): ?>
            <?php /* @var $group stdClass */ ?> 
            <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
                <legend><?php esc_html_e($group->title) ?></legend>
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
            <legend class="wpjb-empty"></legend>
            <input type="submit" value="<?php _e("Register", "jobeleon") ?>" class="wpjb-submit" name="Submit"/>
        </fieldset>

    </form>





</div>
