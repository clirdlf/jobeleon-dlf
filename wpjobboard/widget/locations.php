<?php
/**
 * Locations 
 * 
 * Job locations widget template
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */
?>

<?php echo $theme->before_widget ?>
<?php if ($title) echo $theme->before_title . $title . $theme->after_title ?>

<ul>
    <?php if (!empty($locations)): foreach ($locations as $location): ?>
            <li>
                <a href="<?php esc_attr_e($url.$glue.http_build_query($location["query"])) ?>">
                    <?php esc_html_e($location["title"]) ?>
                    <?php if ($param->count): ?>(<?php echo intval($location["count"]) ?>)<?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php _e("No categories found.", "jobeleon") ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>