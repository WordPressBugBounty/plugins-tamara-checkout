<?php

use Tamara\Wp\Plugin\TamaraCheckout;

$defaultDescription = $viewParams['defaultDescription'] ?? '';
$cartTotal = $viewParams['cartTotal'] ?? 0;
$inlineType = $viewParams['inlineType'] ?? TamaraCheckout::TAMARA_INLINE_TYPE_SINGLE_CHECKOUT_WIDGET;
$totalToCalculate = TamaraCheckout::getInstance()->getTotalToCalculate($cartTotal);

?>
<div class="tamara-gateway-checkout-description">
    <tamara-widget type="tamara-summary" inline-type="<?php echo esc_attr($inlineType) ?>" config='{"badgePosition":"","showExtraContent":"full","hidePayInX":false}' amount="<?php echo esc_attr($totalToCalculate) ?>"></tamara-widget>
    <p class="tamara-gateway-checkout-description__default"><?php echo $defaultDescription ?></p>
</div>
