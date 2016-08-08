<?php
/**
 * Feeds 
 * 
 * Feeds widget template
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

<ul id="wpjb_feeds">
    <li>
        <a  href="<?php echo wpjb_api_url("xml/rss") ?>"><?php _e("All Feeds", "jobeleon"); ?></a>
    </li>
    <?php if (!empty($categories)): foreach ($categories as $category): ?>
            <li>
                <a href="<?php echo wpjb_api_url("xml/rss", array("category"=>$category->slug)) ?>"><?php esc_html_e($category->title) ?></a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php _e("No feeds found.", "jobeleon") ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>