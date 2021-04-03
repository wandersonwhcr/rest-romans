<?php

declare(strict_types=1);

namespace Rest\Romans;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Rest\Romans\App;
use Slim\Psr7\Factory\ServerRequestFactory;

class AppTest extends TestCase
{
    protected function setUp(): void
    {
        $this->app = new App();
    }

    public function testHome(): void
    {
        $request  = $this->buildRequest('GET', '/');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('name', $content);
        $this->assertSame('romans', $content->name);
    }

    public function testArabics(): void
    {
        $request  = $this->buildRequest('GET', '/v1/arabics/1999');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('arabic', $content);
        $this->assertSame('1999', $content->arabic);

        $this->assertObjectHasAttribute('roman', $content);
        $this->assertSame('MCMXCIX', $content->roman);
    }

    public function testRomans(): void
    {
        $request  = $this->buildRequest('GET', '/v1/romans/MCMXCIX');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('roman', $content);
        $this->assertSame('MCMXCIX', $content->roman);

        $this->assertObjectHasAttribute('arabic', $content);
        $this->assertSame('1999', $content->arabic);
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
