<?php

declare(strict_types=1);

namespace RestTest\Romans;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ServerRequestFactory;

trait RequestTrait
{
    /**
     * @param array<string,string> $serverParams
     */
    protected function buildRequest(string $method, string $uri, array $serverParams = []): ServerRequestInterface
    {
        return (new ServerRequestFactory())
            ->createServerRequest($method, $uri, $serverParams);
    }
}
