<?php

declare(strict_types=1);

namespace RestTest\Romans;

use PHPUnit\Framework\TestCase;
use Rest\Romans\Dumb;

class DumbTest extends TestCase
{
    protected function setUp(): void
    {
        $this->dumb = new Dumb();
    }

    public function testTrue(): void
    {
        $this->assertTrue($this->dumb->getTrue());
    }
}
