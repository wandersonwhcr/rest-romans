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
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('name', $content);
        $this->assertSame('romans', $content->name);
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
