<?php

declare(strict_types=1);

namespace Rest\Romans;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ServerRequestFactory;

class AppTest extends TestCase
{
    protected function setUp(): void
    {
        $this->app = require __DIR__ . '/../app.php';
    }

    public function testHome(): void
    {
        $request = $this->buildRequest('GET', '/');

        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param array<string,string> $serverParams
     */
    protected function buildRequest(string $method, string $uri, array $serverParams = []): ServerRequestInterface
    {
        return (new ServerRequestFactory())
            ->createServerRequest($method, $uri, $serverParams);
    }
}
