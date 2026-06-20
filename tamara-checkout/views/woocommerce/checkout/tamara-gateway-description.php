<?php

use Tamara\Wp\Plugin\TamaraCheckout;

$inlineType = $viewParams['inlineType'] ?? 3;
$extraDescription = $viewParams['extraDescription'] ?? '';
$description = $viewParams['description'] ?? '';
$cartTotal = $viewParams['cartTotal'] ?? 0;
$totalToCalculate = TamaraCheckout::getInstance()->getTotalToCalculate($cartTotal);
?>

<div class="payment_method_tamara-gateway">
    <div class="tamara-gateway-description">
        <p class="tamara-gateway-description__default"><?php echo $description ?></p>
        <tamara-widget
            type="tamara-summary"
            amount="<?php echo esc_attr($totalToCalculate) ?>"
            inline-type="<?php echo esc_attr($inlineType) ?>"
            config='{"theme":"light","badgePosition":"","showExtraContent":"full","hidePayInX":false}'>
        </tamara-widget>
        <?php if (!empty($extraDescription)) : ?>
            <p class="tamara-gateway-description__default"><?php echo $extraDescription ?></p>
        <?php endif; ?>
    </div>
</div>
