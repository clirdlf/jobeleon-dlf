<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>

<ul id="wpjb_widget_custommenu" class="wpjb_widget wpjb-widget">
    <?php if(isset($param->structure) && !empty($param->structure)): ?>
    <?php foreach($param->structure as $key => $link): ?>
        <?php if(!wpjb_custom_menu_show_link($link)) continue; ?>
        <?php if($link["menu-item-key"] == "separator:x"): ?>
            <li class="wpjb-custom-menu-separator">
            </li>
        <?php else: ?>
            <li class="wpjb-custom-menu-link <?php esc_attr_e($link["menu-item-classes"]) ?>">
                <a href="<?php esc_html_e(wpjb_custom_menu_key_to_url($link["menu-item-key"])) ?>">
                <?php if($link["menu-item-icon"]): ?>
                <span class="wpjb-glyphs wpjb-custom-menu-icon wpjb-icon-<?php esc_attr_e($link["menu-item-icon"]) ?>"></span>
                <?php endif; ?>
                <?php esc_html_e($link["menu-item-title"]) ?></a>
            </li>
        <?php endif; ?>
            
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No links in the menu", "jobeleon") ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>