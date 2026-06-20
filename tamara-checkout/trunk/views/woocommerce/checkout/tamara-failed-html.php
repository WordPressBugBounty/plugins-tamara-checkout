<?php
// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$textDomain = $viewParams['textDomain'] ?? 'tamara-checkout';
?>
<div class="tamara-canceled-failed-html">
    <?php wc_add_notice(__('We are unable to authorise your payment from Tamara. Please contact us if you need assistance.', 'tamara-checkout'), 'error'); ?>
    <div class="tamara-canceled-failed-html__heading">
        <div class="tamara-canceled-failed-html__heading__logo">
        </div>
        <p class="tamara-canceled-failed-html__heading__text"><?php echo esc_html(__('Payment Failed From Tamara', 'tamara-checkout')) ?></p>
    </div>
    <div class="tamara-canceled-failed-html__content">
        <h4><?php echo esc_html(__('We are unable to proceed your payment via Tamara.', 'tamara-checkout')) ?></h4>
        <h4><?php echo esc_html(__('Please contact us if you need assistance.', 'tamara-checkout')) ?></h4>
    </div>
</div>
