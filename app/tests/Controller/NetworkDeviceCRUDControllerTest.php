<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class NetworkDeviceCRUDControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/network/device/c/r/u/d');

        self::assertResponseIsSuccessful();
    }
}
