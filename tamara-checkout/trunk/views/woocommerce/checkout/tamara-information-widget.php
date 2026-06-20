<?php

use Tamara\Wp\Plugin\TamaraCheckout;

$cartTotal = $viewParams['cartTotal'] ?? 0;
$totalToCalculate = TamaraCheckout::getInstance()->getTotalToCalculate($cartTotal);
$inlineType = $viewParams['inlineType'] ?? TamaraCheckout::TAMARA_INLINE_TYPE_CART_WIDGET_INT;
?>
<tamara-widget type="tamara-summary" amount="<?php echo esc_attr($totalToCalculate); ?>" inline-type="<?php echo esc_attr($inlineType); ?>"></tamara-widget>
