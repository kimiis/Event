<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Bundle\MakerBundle\Maker\LegacyApiTestCase;

class ApiTestCaseTest extends ApiTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/event/');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['h1' => 'Bonjour']);
    }
}
