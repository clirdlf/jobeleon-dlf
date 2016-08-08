<?php

/**
 * Save job
 * 
 * Template displayed when job is being saved
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */

 /* @var $job Wpjb_Model_Job */
 /* @var $info array List of generated messages */
 /* @var $cart boolean Show cart? */
?>
<div class="where-am-i">
    <h2><?php _e('Add job', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-save">

    
    <?php wpjb_add_job_steps(); ?>
    <?php wpjb_flash(); ?>
    
    <?php if(!empty($info)): ?>
    <div class="wpjb-flash-info">
        <div class="wpjb-flash-icon">
            <span class="wpjb-glyphs wpjb-icon-ok"></span>
        </div>
        <div class="wpjb-flash-body">
        <?php foreach($info as $message): ?>
            <p><?php echo $message ?></p> 
        <?php endforeach; ?>
        </div>
    </div>
    
    <?php endif; ?>
    
    <?php if($cart): ?>
    <?php include_once $this->getFile("../default/payment.php") ?>
    <?php endif; ?>
</div>

