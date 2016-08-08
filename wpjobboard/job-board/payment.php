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
/* @var $button Wpjb_Payment_PayPal */
/* @var $payment Wpjb_Model_Payment Payment object */
?>
<div class="where-am-i">
    <h2><?php _e('Payment', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->

<div id="wpjb-main" class="wpjb-page-save">



    <table class="wpjb-info" id="wpjb-payment">
        <tbody>
            <tr>
                <td><b><?php _e("Payment", "jobeleon") ?>:</b></td>
                <td>
                    <?php if ($payment->object_type == 1): ?>
                        <?php _e("Payment for job posting.", "jobeleon") ?><br/>
                        &quot;<i><?php esc_html_e($job->job_title) ?></i>&quot;
                    <?php else: ?>
                        <?php _e("Payment for resumes access.") ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><b><?php _e("To Pay", "jobeleon") ?>:</b></td>
                <td><?php esc_html_e($currency . sprintf("%.2f", $payment->payment_sum - $payment->payment_paid)) ?></td>
            </tr>
            <tr class="wpjb-no-border">
                <td>&nbsp</td>
                <td><?php echo $button->render() ?></td>
            </tr>
        </tbody>
    </table>
</div>