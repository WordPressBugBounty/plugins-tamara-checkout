<br>
<?php echo esc_html(__('Thank you for choosing Tamara! We will inform you once the merchant ships your order.', 'tamara-checkout')) ?>
<div class="tamara-view-and-pay-button">
    <div class="tamara-view-and-pay-button__text">
        <a href="https://app.tamara.co/payments" class="tamara-view-and-pay-button__text--up"
           target="_blank"><?php echo esc_html(__('View Your Orders',
                'tamara-checkout')) ?></a>
        <?php if (!empty($viewParams['showPayButton'])) : ?>
        <a href="https://app.tamara.co" class="tamara-view-and-pay-button__text--down" id="tamara-order-pay-button"
           target="_blank"><?php echo esc_html(__('Go to Tamara and pay',
                'tamara-checkout')) ?></a>
        <?php endif; ?>
    </div>
</div>
