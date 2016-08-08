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

$search_url = wpjb_link_to("home");

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
        <form action="<?php esc_attr_e(get_permalink($page_id)) ?>" method="get">
            <?php if (!get_option('permalink_structure')): ?>
                <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
                <input type="hidden" name="job_board" value="find" />
            <?php endif; ?>
            <?php if ($current_type): ?>
                <input type="hidden" name="type" value="<?php esc_attr_e($current_type->id) ?>" />
            <?php endif; ?>
            <div class="wpjb-btn-with-input wpjb-search-query">
                <input type="text" name="query" class="wpjb-ls-query" placeholder="<?php _e('Search with keyword, location, company', 'jobeleon'); ?>" value="<?php esc_attr_e($param["query"]) ?>" />
                <input type="submit" class="btn" value="<?php _e("Search", "jobeleon") ?>" />
            </div>
            <div class="wpjb-search-category">
                <select id="category" name="category" class="wpjb-ls-category">
                    <option value=""><?php _e('All categories', 'jobeleon'); ?></option>
                    <?php
                    $job_categories = wpjb_form_get_categories();
                    foreach ($job_categories as $cat) :
                        ?>

                        <option value="<?php echo $cat['value']; ?>" <?php selected($cat['value'], $param["category"]); ?>><?php echo $cat['description']; ?></option>	

                    <?php endforeach; ?>	
                </select>
            </div>

        </form>
    </div><!-- /search -->
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-index">
    <?php
    $job_types = wpjb_get_jobtypes();
    if ($job_types) :
        ?>
        <div class="wpjb-filters">
            <ul class="wpjb-filter-list">
                <li class="wpjb-top-filter wpjb-all-jobs-filter">
                    <a class="wpjb-ls-type-main" href="<?php esc_attr_e($search_url . $spoiler2 . http_build_query(array("query" => $param["query"], "category" => $param["category"], "type" => $param["type"]))); ?>">
                        <?php if ($current_type): ?>
                            <?php esc_html_e($current_type->title) ?> &#32;&#x25BE;
                        <?php else: ?>
                            <?php _e('All Jobs', 'jobeleon'); ?> &#32;&#x25BE;
                        <?php endif; ?>
                    </a>
                    <ul class="wpjb-sub-filters">
                        <li><a class="wpjb-ls-type <?php if (!$current_type): ?>wpjb-ls-checked<?php endif; ?>" data-wpjb-id="0" href="<?php esc_attr_e($search_url . $spoiler2 . http_build_query(array("query" => $param["query"], "category" => $param["category"]))) ?>"><?php _e('All Jobs', 'jobeleon') ?></a></li>
                        <?php foreach ($job_types as $type) : ?>
                            <li><a class="wpjb-ls-type <?php if ($current_type && $current_type->id == $type->id): ?>wpjb-ls-checked<?php endif; ?>" data-wpjb-id="<?php esc_html_e($type->id) ?>" href="<?php esc_attr_e($search_url . $spoiler . http_build_query(array("query" => $param["query"], "category" => $param["category"], "type" => $type->id))); ?>"><?php echo $type->title; ?></a></li>
                        <?php endforeach; ?>
                    </ul><!-- .wpjb-sub-filters -->
                </li><!-- .wpjb-top-filter .wpjb-all-jobs-filter -->
            </ul><!-- .wpjb-filter-list -->
        </div><!-- .wpjb-filters -->
    <?php endif; ?>
    <div class="wpjb-over-job-table">
        <div class="wpjb-breadcrumb-top">
            <p>
                <?php _e("You're currently browsing", 'jobeleon') ?>:
                <strong class="wpjb-ls-type-title"><?php echo (!$current_type) ? __('All Jobs', 'jobeleon') : esc_html($current_type->title) ?></strong>
                I 
                <strong class="wpjb-ls-category-title"><?php echo (!$current_category) ? __('All Categories', 'jobeleon') : esc_html($current_category->title) ?></strong>
            </p>
        </div>
        <a href="#" class="wpjb-subscribe"><img src="<?php esc_attr_e(get_template_directory_uri() . '/wpjobboard/images/subscribe-icon.png') ?>" alt="<?php _e("Subscribe", "jobeleon") ?>" /></a>
        <br style="clear:both;" />
    </div><!-- .wpjb-over-job-table -->

    <?php wpjb_flash(); ?>

    <table id="wpjb-job-list" class="wpjb-table">
        <tbody class="wpjb-job-list">
            <?php $result = apply_filters("wpjb_filter_jobs", wpjb_find_jobs($param), $atts) ?>
            <?php if ($result->count) : foreach ($result->job as $job): ?>
                    <?php /* @var $job Wpjb_Model_Job */ ?>
                    <?php $this->job = $job; ?>
                    <?php $this->render("index-item.php") ?>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3" class="wpjb-table-empty">
                        <?php _e("No job listings found.", "jobeleon"); ?>
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

<?php if (get_option("wpjobboard_theme_ls")): ?>
    <script type="text/javascript">
        jQuery(function($) {
            WPJB_SEARCH_CRITERIA = <?php echo json_encode($search_init) ?>;
            wpjb_ls_jobs_init();
        });
    </script>
<?php endif; ?>

<!-- Begin: Subscribe to anything -->
<?php Wpjb_Project::getInstance()->setEnv("search_feed_url", $result->url->feed); ?>
<?php Wpjb_Project::getInstance()->setEnv("search_params", $param); ?>
<?php add_action("wp_footer", "wpjb_subscribe") ?>
<!-- End: Subscribe to anything -->
