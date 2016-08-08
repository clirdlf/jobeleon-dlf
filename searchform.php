<?php
/**
 * The template for displaying search forms in wpjobboard_theme
 *
 * @package wpjobboard_theme
 */
?>
<form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
    <label class="screen-reader-text"><?php _ex('Search', 'assistive text', 'jobeleon'); ?></label>
    <input type="search" class="field" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'jobeleon'); ?>" />
    <input type="submit" class="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'jobeleon'); ?>" />
</form>
