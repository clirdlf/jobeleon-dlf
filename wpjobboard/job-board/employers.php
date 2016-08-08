<?php
/**
 * Jobs list
 * 
 * This template file is responsible for displaying list of jobs on job board
 * home page, category page, job types page and search results page.
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $param array List of job search params
 * @var $search_init array Array of initial search params (used only with live search)
 * @var $pagination bool Show or hide pagination
 */
?>

<?php
$all_null = true;

foreach (array("query", "category", "type") as $p) {
    $ls_default[$p] = "";
    if (!isset($param[$p])) {
        $param[$p] = null;
    } else {
        $all_null = false;
    }
}

if (get_option('permalink_structure')) {
    $spoiler = "?";
} else {
    $spoiler = "&";
}

if ($all_null) {
    $spoiler2 = "";
} else {
    $spoiler2 = $spoiler;
}

$search_url = wpjb_link_to("search");

$current_category = null;
$current_type = null;

if ($param["type"] > 0) {
    $current_type = new Wpjb_Model_Tag($param["type"]);
    if (!$current_type->exists() || $current_type->type != "type") {
        $current_type = null;
    }
}

if ($param["category"] > 0) {
    $current_category = new Wpjb_Model_Tag($param["category"]);
    if (!$current_category->exists() || $current_category->type != "category") {
        $current_category = null;
    }
}
?>

<div class="index-where-am-i where-am-i">
    <div id="search">
        <form action="" method="get">
            <?php if (!get_option('permalink_structure')): ?>
                <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
            <?php endif; ?>
            <div class="wpjb-btn-with-input wpjb-search-query" style="width:100%">
                <input type="text" name="query" class="wpjb-ls-query" placeholder="<?php _e('Search with keyword, location, company', 'jobeleon'); ?>" value="<?php esc_attr_e($param["query"]) ?>" />
                <input type="submit" class="btn" value="<?php _e("Search", "jobeleon") ?>" />
            </div>

        </form>
    </div><!-- /search -->
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-employers">

    <?php wpjb_flash(); ?>

    <table id="wpjb-job-list" class="wpjb-table">
        <tbody>
            <?php $result = Wpjb_Model_Company::search($param) ?>
            <?php if ($result->count) : foreach ($result->company as $company): ?>
                    <?php /* @var $job Wpjb_Model_Company */ ?>
                    <?php $this->company = $company; ?>
                    <?php $this->render("employers-item.php") ?>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3" class="wpjb-table-empty">
                        <?php _e("No employers found.", "jobeleon"); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($pagination): ?>
    <div id="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
    </div>
    <?php endif; ?>


</div>

