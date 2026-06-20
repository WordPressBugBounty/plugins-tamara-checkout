<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Request\FastTamara;

use Tamara\Wp\Plugin\Dependencies\Tamara\Request\AbstractRequestHandler;
use Tamara\Wp\Plugin\Dependencies\Tamara\Response\FastTamara\FastTamaraEligibilityResponse;

class FastTamaraEligibilityRequestHandler extends AbstractRequestHandler
{
    private const PRE_CHECKOUT_ELIGIBILITY_ENDPOINT = '/pre-checkout/v1/eligibility';

    public function __invoke(FastTamaraEligibilityRequest $request)
    {
        $response = $this->httpClient->post(
            self::PRE_CHECKOUT_ELIGIBILITY_ENDPOINT,
            $request->getFastTamaraEligibility()->toArray()
        );

        return new FastTamaraEligibilityResponse($response);
    }
}
