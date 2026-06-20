<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Response\FastTamara;

use Tamara\Wp\Plugin\Dependencies\Tamara\Response\ClientResponse;

class FastTamaraEligibilityResponse extends ClientResponse
{
    public const IS_ELIGIBLE = 'is_eligible';

    private $isEligible;

    public function isEligible(): bool
    {
        return boolval($this->isEligible);
    }

    protected function parse(array $responseData): void
    {
        $this->isEligible = $responseData[self::IS_ELIGIBLE] ?? true;
    }
}
