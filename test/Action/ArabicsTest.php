<?php

declare(strict_types=1);

namespace RestTest\Romans\Action;

use PHPUnit\Framework\TestCase;
use Rest\Romans\App;
use RestTest\Romans\RequestTrait;

class ArabicsTest extends TestCase
{
    use RequestTrait;

    protected function setUp(): void
    {
        $this->app = new App();
    }

    public function testValue(): void
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

    public function testNegative(): void
    {
        $request  = $this->buildRequest('GET', '/v1/arabics/-1');
        $response = $this->app->handle($request);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('message', $content);
    }

    public function testFloat(): void
    {
        $request  = $this->buildRequest('GET', '/v1/arabics/3.1415');
        $response = $this->app->handle($request);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeader('Content-Type'));
        $this->assertCount(1, $response->getHeader('Content-Type'));

        $content = json_decode((string) $response->getBody());

        $this->assertObjectHasAttribute('message', $content);
    }
}
