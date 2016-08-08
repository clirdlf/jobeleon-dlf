<div class="where-am-i">
    <?php wpjb_breadcrumbs($breadcrumbs) ?>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjr-page-my-applications">

    <?php wpjb_flash() ?>
    
    <table id="wpjb-resume-list" class="wpjb-table">
        <thead>
            <tr>
                <th><?php _e("Job", "jobeleon") ?></th>
                <th><?php _e("Expires", "jobeleon") ?></th>
                <th class="wpjb-last">&nbsp;</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($result->count > 0) : foreach($result->shortlist as $item): ?>
            <?php /* @var $item Wpjb_Model_Shortlist */ ?>
            <?php $object = $item->getObject() ?>
            <tr>
                <td>
                    <?php if($object && (in_array(Wpjb_Model_Job::STATUS_ACTIVE, $object->status()) || in_array(Wpjb_Model_Job::STATUS_INACTIVE, $object->status()) || in_array(Wpjb_Model_Job::STATUS_EXPIRED, $object->status()))): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("job", $object)) ?>"><?php esc_html_e($object->job_title) ?></a>
                    <?php echo join(" ", wpjb_bulb($object)) ?>
                    <?php else: ?>
                    <?php _e("Job is inactive or deleted.", "jobeleon") ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($object && $object->job_expires_at == WPJB_MAX_DATE): ?>
                    <?php _e("Never", "jobeleon") ?>
                    <?php elseif($object): ?>
                    <?php esc_html_e(wpjb_date_display(get_option('date_format'), $object->job_expires_at)) ?>
                    <?php else: ?>
                    -
                    <?php endif; ?>
                </td>
                <td class="wpjb-last">
                    <a href="<?php esc_attr_e(wpjb_api_url("action/bookmark", array("object"=>"job", "object_id"=>$item->object_id, "redirect_to"=>$url, "do"=>"delete"))) ?>">
                        <?php _e("Delete", "jobeleon") ?>
                    </a>
                </td>
            </tr>
            <?php endforeach; else :?>
            <tr>
                <td colspan="3" align="center">
                    <?php _e("You do not have any jobs shortlisted.", "jobeleon"); ?>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query) ?>
    </div>

</div>