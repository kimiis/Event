<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class TestCaseTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    private function assertTrue(bool $true)
    {
    }
}
