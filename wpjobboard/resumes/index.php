<?php
/**
 * Resumes list
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */
/* @var $resumeList array of Wpjb_Model_Resume objects */
/* @var $can_browse boolean True if user has access to resumes */
?>

<?php
$all_null = true;

foreach (array("query", "category", "type") as $p) {
    if (!isset($param[$p])) {
        $param[$p] = null;
    } else {
        $all_null = false;
    }
}
?>

<div class="index-where-am-i where-am-i">
    <div id="search">
        <form method="get" action="<?php echo wpjr_link_to("search") ?>">
            <?php if (!get_option('permalink_structure')): ?>
                <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
                <input type="hidden" name="job_resumes" value="find" />
            <?php endif; ?>

            <div class="wpjb-btn-with-input wpjb-search-query">
                <input type="text" id="search-field" name="query" class="text wpjb-ls-query" placeholder="<?php _e("Search Resumes with keyword", 'jobeleon') ?>" value="<?php esc_attr_e($param["query"]) ?>" />
                <input type="submit" class="btn" value="Search" />
            </div>
            <div class="wpjb-search-category">
                <select id="category" name="category" class="wpjb-ls-category">
                    <option value=""><?php _e('All categories', 'jobeleon'); ?></option>
                    <?php
                    $job_categories = wpjb_form_get_categories();
                    foreach ($job_categories as $cat) :
                        ?>

                        <option value="<?php echo $cat['value']; ?>" <?php selected($cat['value'], $param['category']); ?>><?php echo $cat['description']; ?></option>	

                    <?php endforeach; ?>	
                </select>
            </div><!-- .wpjb-search-category -->
        </form>
    </div><!-- /search -->

</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjr-page-resumes">

    <?php wpjb_flash(); ?>

    <table id="wpjb-resume-list" class="wpjb-table">
        <tbody>
            <?php $result = wpjb_find_resumes($param); ?>
            <?php if ($result->count > 0) : foreach ($result->resume as $resume): ?>
                    <?php /* @var $resume Wpjb_Model_Resume */ ?>
                    <?php $this->resume = $resume; ?>
                    <?php $this->render("index-item.php") ?>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3" align="center">
                        <?php _e("No resumes found.", "jobeleon"); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
    </div>


</div>

<?php if (get_option("wpjobboard_theme_ls")): ?>
    <script type="text/javascript">
        if (typeof ajaxurl === 'undefined') {
            ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
        }
        jQuery(function($) {
            wpjb_ls_resumes_init();
        });
    </script>
<?php endif; ?>