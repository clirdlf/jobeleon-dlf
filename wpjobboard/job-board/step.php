<?php $currentStep = wpjb_view("current_step"); ?>
<div class="wpjb-step-container">
    <ol id="wpjb-step" class="wpjb-step-<?php echo $currentStep; ?>">
        <?php wpjobboard_theme_render_step(1, '{text}'); ?>
        <?php wpjobboard_theme_render_step(2, '{text}'); ?>
        <?php wpjobboard_theme_render_step(3, '{text}'); ?>
    </ol>
</div>
