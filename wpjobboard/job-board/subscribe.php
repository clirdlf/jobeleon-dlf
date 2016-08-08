<!-- START: Subscribe overlay -->
<div id="wpjb-overlay" class="wpjb-overlay">
    <div>
        <div class="wpjb-subscribe-head">
            <h2>
                <?php _e("Subscribe To Personalized Notifications", "jobeleon") ?>
                <a href="#" class="wpjb-overlay-close"><img src="<?php esc_attr_e(get_template_directory_uri() . '/wpjobboard/images/close-icon.png') ?>" alt="" /></a>
            </h2>

            <p>
                <?php _e("You are subscribing to jobs matching your current search criteria.", "jobeleon") ?>
            </p>
        </div><!-- .wpjb-subscribe-head -->
        <div class="wpjb-subscribe-content wpjb-subscribe-email">
            <strong>
                <img src="<?php esc_attr_e(get_template_directory_uri() . '/wpjobboard/images/email-icon.png') ?>" alt="" />
                <?php _e("Email Notifications", "jobeleon") ?>
            </strong>
            <form action="" method="post">
                <p>
                    <span><?php _e("Email notifications will be sent to you", "jobeleon") ?></span>

                    <label class="wpjb-mail-frequency" for="wpjb-mail-frequency-daily"><?php _e("Daily", "jobeleon") ?>
                        <input type="radio" value="1" name="frequency[]" id="wpjb-mail-frequency-daily" class="wpjb-subscribe-frequency" checked="checked" />
                    </label>

                    <label class="wpjb-mail-frequency" for="wpjb-mail-frequency-weekly"><?php _e("Weekly", "jobeleon") ?>
                        <input type="radio" value="2" name="frequency[]" id="wpjb-mail-frequency-weekly" class="wpjb-subscribe-frequency" />
                    </label>


                <div class="wpjb-btn-with-input">
                    <input type="text" placeholder="<?php _e("enter your email address here ...", "jobeleon") ?>" id="wpjb-subscribe-email" value="" name="email" />
                    <a href="" class="wpjb-button wpjb-subscribe-save btn">
                        <?php _e("Subscribe", "jobeleon") ?>
                    </a>
                </div>

                <img alt="" class="wpjb-subscribe-load" src="<?php echo get_admin_url() ?>/images/wpspin_light.gif" style="display:none" />

                <span class="wpjb-subscribe-result">&nbsp;</span>
                </p>
            </form>
        </div><!-- .wpjb-subscribe-content -->

        <div class="wpjb-subscribe-content wpjb-subscribe-rss">
            <strong>
                <img src="<?php esc_attr_e(get_template_directory_uri() . '/wpjobboard/images/rss-feed-icon.png') ?>" alt="" />
                <?php _e("Custom RSS Feed", "jobeleon") ?>
            </strong>
            <form action="" method="post">

                <p>
                    <span><?php _e("Your personalized RSS Feed is below, copy the address to your RSS reader.", "jobeleon") ?></span>

                <div class="wpjb-btn-with-input">
                    <input type="text" value="<?php esc_attr_e($feed_url) ?>" name="feed" readonly="readonly" />
                    <a href="<?php esc_attr_e($feed_url) ?>" class="wpjb-button btn">
                        <?php _e("Subscribe", "jobeleon") ?>
                    </a>
                </div>
                </p>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    if (typeof ajaxurl === 'undefined') {
        ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
    }
    <?php $pj = array() ?>
    <?php foreach($param as $k=>$v): ?>
    <?php if(!empty($v) && !in_array($k, array("page", "count"))) $pj[$k] = $v ?>
    <?php endforeach; ?>
    WPJB_SEARCH_CRITERIA = <?php echo json_encode($pj) ?>;
</script>

<!-- END: Subscribe overlay -->
