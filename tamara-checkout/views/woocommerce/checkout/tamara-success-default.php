<?php
// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$tamara_checkout_authorise_success_url = $viewParams['authoriseSuccessUrl'] ?? null;
get_header();
?>

<div id="tamara-success-overlay"></div>
<div class="tamara-success-default">
    <div class="tamara-success-default__heading">
        <div class="tamara-success-default__heading__logo">
        </div>
        <p class="tamara-success-default__heading__text"><?php echo esc_html(__('Order Received by Tamara', 'tamara-checkout')) ?></p>
    </div>
    <div class="tamara-success-default__content">
        <h4><?php echo esc_html(__("Please don't close this window.", 'tamara-checkout')) ?></h4>
        <h4><?php echo esc_html(__('Your order paying with Tamara is still under process.', 'tamara-checkout')) ?></h4>
        <h4><?php 
            // translators: %s: Link to redirect URL
            $tamara_link = '<a href="' . esc_url($tamara_checkout_authorise_success_url) . '">' . esc_html(__('click here', 'tamara-checkout')) . '</a>';
            echo wp_kses_post(sprintf(__("Please %s if you are not redirected automatically after 30 seconds.", 'tamara-checkout'), $tamara_link));
        ?></h4>
    </div>
</div>

<?php
get_footer();
