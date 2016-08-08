<?php
/**
 * Edit company profile
 * 
 * Displays company profile form. Employer can edit his company page here.
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $form Wpjb_Form_Frontend_Company Company edit form */
/* @var $company Wpjb_Model_Employer Currently logged in employer object */
?>

<div class="where-am-i">
    <h2><?php _e('Employer Dashboard', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main">
    <?php include_once Wpjb_Project::getInstance()->env("template_base").'job-board/company-home.php' ?>
</div>