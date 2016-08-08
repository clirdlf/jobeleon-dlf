<?php echo $theme->before_widget ?>
<?php if ($title) echo $theme->before_title . $title . $theme->after_title ?>

<?php
$keyword_label = __("Keyword", "jobeleon");
$email_label = __("E-Mail", "jobeleon");
?>

<?php if($is_smart): ?>

<div class="wpjb-widget-smart-alert">
    <div><p><?php _e("Like this job search results?", "jobeleon") ?></p></div>
    <a href="#" class="wpjb-subscribe wpjb-button" style="width:100%;display:inline-block;box-sizing:border-box;"><?php _e("Subscribe Now ...", "jobeleon") ?></a>
</div>

<?php else: ?>

<?php wp_enqueue_script('wpjb-alert'); ?>

<script type="text/javascript">
if (typeof ajaxurl === 'undefined') {
    ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
}
</script>

<div clss="wpjb-widget-alert wpjb">
    <form action="<?php esc_attr_e(wpjb_link_to("alert_confirm")) ?>" method="post">
        <input type="hidden" name="add_alert" value="1" />
        <ul id="wpjb_widget_alerts" class="wpjb_widget">
            <?php $form = new Wpjb_Form_Frontend_Alert() ?>
            <?php foreach($form->getReordered() as $group): ?>
                <?php foreach($group->getReordered() as $name => $field): ?>
                <li style="margin-bottom:15px">
                    <?php echo $field->render() ?>
                </li>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <li>
                <div class="wpjb-widget-alert-result" style="padding:2px 6px; margin: 0 0 5px 0; display: none"></div>
                <input type="submit" class="wpjb-button wpjb-widget-alert-save" value="<?php _e("Create Email Alert", "jobeleon") ?>" />
            </li>
        </ul>
        
    </form>
</div>

<?php endif; ?>
<?php echo $theme->after_widget ?>
