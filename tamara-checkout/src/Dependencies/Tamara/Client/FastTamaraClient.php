<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Client;

use Tamara\Wp\Plugin\Dependencies\Tamara\Exception\RequestDispatcherException;
use Tamara\Wp\Plugin\Dependencies\Tamara\HttpClient\FastTamaraHttpAdapter;
use Tamara\Wp\Plugin\Dependencies\Tamara\HttpClient\HttpClient;
use Tamara\Wp\Plugin\Dependencies\Tamara\Request\FastTamara\FastTamaraEligibilityRequest;
use Tamara\Wp\Plugin\Dependencies\Tamara\Request\RequestDispatcher;
use Tamara\Wp\Plugin\Dependencies\Tamara\Response\FastTamara\FastTamaraEligibilityResponse;

class FastTamaraClient
{
    private $requestDispatcher;

    public function __construct(string $apiUrl, string $apiToken)
    {
        $httpClient = new HttpClient($apiUrl, $apiToken, new FastTamaraHttpAdapter());
        $this->requestDispatcher = new RequestDispatcher($httpClient);
    }

    /**
     * @throws RequestDispatcherException
     */
    public function checkEligibility(FastTamaraEligibilityRequest $request): FastTamaraEligibilityResponse
    {
        return $this->requestDispatcher->dispatch($request);
    }
}
