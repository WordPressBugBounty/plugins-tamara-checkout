<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Request\FastTamara;

use Tamara\Wp\Plugin\Dependencies\Tamara\Model\FastTamara\FastTamaraEligibility;

class FastTamaraEligibilityRequest
{
    private $fastTamaraEligibility;

    public function __construct(FastTamaraEligibility $fastTamaraEligibility)
    {
        $this->fastTamaraEligibility = $fastTamaraEligibility;
    }

    public function getFastTamaraEligibility(): FastTamaraEligibility
    {
        return $this->fastTamaraEligibility;
    }
}
