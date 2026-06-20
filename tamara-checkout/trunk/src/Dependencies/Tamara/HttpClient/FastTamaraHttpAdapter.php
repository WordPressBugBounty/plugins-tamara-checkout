<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\HttpClient;

use Tamara\Wp\Plugin\Dependencies\Buzz\Client\Curl;
use Tamara\Wp\Plugin\Dependencies\Nyholm\Psr7\Factory\Psr17Factory;
use Tamara\Wp\Plugin\Dependencies\Psr\Http\Message\RequestInterface;
use Tamara\Wp\Plugin\Dependencies\Psr\Http\Message\ResponseInterface;
use Tamara\Wp\Plugin\Dependencies\Psr\Log\LoggerInterface;
use Tamara\Wp\Plugin\Dependencies\Tamara\Exception\RequestException;

class FastTamaraHttpAdapter implements ClientInterface
{
    private const REQUEST_TIMEOUT_MS = 3000;

    private $client;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->client = new Curl(new Psr17Factory());
    }

    public function createRequest(
        string $method,
        $uri,
        array $headers = [],
        $body = null,
        $version = '1.1'
    ): RequestInterface {
        return new \Tamara\Wp\Plugin\Dependencies\Nyholm\Psr7\Request(
            $method,
            $uri,
            $headers,
            $body
        );
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->sendRequest(
                $request,
                [
                    'curl' => [
                        CURLOPT_TIMEOUT_MS => self::REQUEST_TIMEOUT_MS,
                    ],
                ]
            );
        } catch (\Throwable $exception) {
            throw new RequestException(
                $exception->getMessage(),
                $exception->getCode(),
                $request,
                null,
                $exception->getPrevious()
            );
        }
    }
}
