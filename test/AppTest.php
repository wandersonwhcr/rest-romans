<?php

declare(strict_types=1);

namespace RestTest\Romans;

use PHPUnit\Framework\TestCase;
use Rest\Romans\App;

class AppTest extends TestCase
{
    use RequestTrait;

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
}
