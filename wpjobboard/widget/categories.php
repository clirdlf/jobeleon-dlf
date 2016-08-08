<?php
/**
 * Categories 
 * 
 * Categories widget template
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */
/* @var $categories array List of Wpjb_Model_Tag objects */
/* @var $param stdClass Widget configurations options */
?>

<?php echo $theme->before_widget ?>
<?php if ($title) echo $theme->before_title . $title . $theme->after_title ?>

<ul>
    <?php if (!empty($categories)): foreach ($categories as $category): ?>
            <?php if ($param->hide_empty && !$category->getCount()) continue; ?>
            <li>
                <a href="<?php echo wpjb_link_to("category", $category) ?>">
                    <?php esc_html_e($category->title) ?>
                    <?php if ($param->count): ?>(<?php echo intval($category->getCount()) ?>)<?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php _e("No categories found.", "jobeleon") ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>