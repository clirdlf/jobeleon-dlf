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

 /* @var $payment Object Payment form */
 /* @var $payment_form String */

$taxer = new Wpjb_Utility_Taxer();
$taxer->setPrice($pricing->price);

wp_enqueue_script( 'wpjb-payment' );

$standalone = !(isset($current_step) && $current_step == 3);

?>

<?php if($standalone): ?>
<div class="where-am-i">
    <?php if(isset($breadcrumbs)): wpjb_breadcrumbs($breadcrumbs); else: ?>
    <h2><?php _e('Payment', 'jobeleon'); ?></h2>
    <?php endif; ?>
</div><!-- .where-am-i -->
<?php endif; ?>

<div <?php if($standalone): ?>id="wpjb-main"<?php endif; ?> class="wpjb-page-default-payment">

    <?php if($standalone): ?>
    <header class="entry-header">
        <h1 class="entry-title" style="padding:1em 0; font-size:1.6em"><?php esc_html_e(Wpjb_Project::getInstance()->title) ?></h1>
    </header>
    <?php endif; ?>
    
    <?php wpjb_flash(); ?>
    
    <?php echo $defaults ?>
    
    <div id="wpjb-checkout" class="wpjb-grid wpjb-grid-closed-top">
        <div class="wpjb-grid-row" style="background-color: #eff0f2; font-weight: bold">
            <div class="wpjb-col-65"><?php _e("Item", "jobeleon") ?></div>
            <div class="wpjb-col-30 wpjb-grid-col-right"><?php _e("Price", "jobeleon") ?></div>
        </div> 
        <div class="wpjb-grid-row wpjb-payment-item">
            <div class="wpjb-col-65"><?php esc_html_e($pricing_item) ?></div>
            <div class="wpjb-col-30 wpjb-grid-col-right"><span class="wpjb-value" data-price-default="<?php esc_html_e(wpjb_price($taxer->value->price, $pricing->currency)) ?>" data-pricing-id="<?php echo $pricing->id ?>"><?php esc_html_e(wpjb_price($taxer->value->price, $pricing->currency)) ?></span></div>
        </div>   
        <div class="wpjb-grid-row wpjb-payment-discount wpjb-none">
            <div class="wpjb-col-65"><?php _e("Discount", "jobeleon") ?></strong></div>
            <div class="wpjb-col-30 wpjb-grid-col-right"><span class="wpjb-value" data-price-default="<?php esc_html_e(wpjb_price($taxer->value->discount, $pricing->currency)) ?>"><?php esc_html_e(wpjb_price($taxer->value->discount, $pricing->currency)) ?></span></div>
        </div>            
        <div class="wpjb-grid-row wpjb-payment-total">
            <div class="wpjb-col-65" >
                <?php if($taxer->isEnabled()): ?>
                <span class="wpjb-payment-tax-label"><?php _e("Subtotal", "jobeleon") ?></span>
                <span class="wpjb-payment-tax-label"><?php echo sprintf(__('%1$s @ %2$s', "jobeleon"), "VAT", intval($taxer->value->rate)."%") ?></span>
                <?php endif; ?>
                <strong style="font-size: larger"><?php _e("Total", "jobeleon") ?></strong>
            </div>
            <div class="wpjb-col-30 wpjb-grid-col-right">
                <?php if($taxer->isEnabled()): ?>
                <span class="wpjb-payment-tax-label wpjb-value-subtotal" data-price-default="<?php esc_html_e(wpjb_price($taxer->value->subtotal, $pricing->currency)) ?>"><?php esc_html_e(wpjb_price($taxer->value->subtotal, $pricing->currency)) ?></span>
                <span class="wpjb-payment-tax-label wpjb-value-tax" data-price-default="<?php esc_html_e(wpjb_price($taxer->value->tax, $pricing->currency)) ?>"><?php esc_html_e(wpjb_price($taxer->value->tax, $pricing->currency)) ?></span>
                <?php endif; ?>
                <strong class="wpjb-value" style="font-size:larger" data-price-default="<?php esc_html_e(wpjb_price($taxer->value->total, $pricing->currency)) ?>"><?php esc_html_e(wpjb_price($taxer->value->total, $pricing->currency)) ?></strong>
            </div>
        </div>
    </div>
    
    <div class="" style="padding:0 1% 0 1%; border-color: whitesmoke; margin-top:30px; margin-bottom: 30px">
        
        <span class="wpjb-enter-discount-start">
            <?php _e("Have a discount code?", "jobeleon") ?>
            <a href="#" class="wpjb-enter-discount" rel="nofollow"><?php _e("Click to enter it.", "jobeleon") ?></a>
        </span>
        
        <span class="wpjb-none wpjb-enter-discount-applied">
            <span class="wpjb-glyphs wpjb-icon-ok"></span>
            <span class="wpjb-enter-discount-msg"></span>
            <a href="#" class="wpjb-enter-discount" rel="nofollow"><?php _e("Change", "jobeleon") ?></a>
        </span>
        
        <div class="wpjb-enter-discount-form wpjb-none" style="margin: 1em 0 0 0 ">
            <input name="discount" class="wpjb-enter-discount-value" type="text" value="" autocomplete="off" />
            <a href="#" class="wpjb-enter-discount-apply wpjb-button"><?php _e("Apply", "jobeleon") ?></a>
            <span class="wpjb-glyphs wpjb-icon-spinner wpjb-animate-spin" style="visibility:hidden; font-size: 18px; vertical-align: middle; color: black;"></span>
            
            <span class="wpjb-none wpjb-enter-discount-failed">
                <span class="wpjb-glyphs wpjb-icon-cancel-circled"></span>
                <span class="wpjb-enter-discount-msg"></span>
            </span>
        </div>
        
    </div>

    <div class="wpjb-checkout-free wpjb-none">
        <div class="wpjb-flash-info">
            <?php printf(__('<strong>100%% discount applied.</strong><br/> Click "%1$s" button to skip payment and complete your order.'), __("Place Order", "jobeleon")) ?>
        </div>
    </div>
    
    <?php if(empty($gateways)): ?>
    
    <div class="wpjb-flash-error">
        <?php _e("No payment methods enabled!", "jobeleon") ?>
    </div>
    
    <?php else: ?>
    
    <ul id="wpjb-checkout-gateway" class="wpjb-tabs wpjb-tabs-reverse">
        <?php $is_first = true ?>
        <?php foreach($gateways as $gclass): ?>
        <?php $gateway = new $gclass; ?>
        <li class="wpjb-tab-link <?php echo $is_first ? 'current' : '' ?>" data-gateway="<?php echo $gclass ?>">
            <?php if($gateway->getIconFrontend()): ?>
            <span class="wpjb-glyphs <?php echo $gateway->getIconFrontend() ?>"></span>
            <?php endif; ?>
            <a href="#1234"><?php esc_html_e($gateway->getCustomTitle()) ?></a> 
        </li>
        <?php $is_first = false; ?>
        <?php endforeach; ?>
    </ul>
    
    
    <div class="wpjb-grid wpjb-grid-compact wpjb-tab-content wpjb-checkout-form" style="padding:1em 15px 1em 15px">
        <span class="wpjb-glyphs wpjb-icon-spinner wpjb-animate-spin"></span>
    </div>
    
    <div id="wpjb-checkout-success" class="wpjb-none"></div>
    
    <div class="wpjb-place-order-wrap" style="margin-top:30px;">
        <a href="#" class="wpjb-button wpjb-place-order"><?php _e("Place Order", "jobeleon") ?></a>
        <span class="wpjb-glyphs wpjb-icon-spinner wpjb-animate-spin" style="visibility:hidden; font-size: 18px; vertical-align: middle; color: black;"></span>
    </div>

    <?php endif; ?>
</div>

