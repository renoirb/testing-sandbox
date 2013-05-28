<?php

namespace Acme\BillerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BillControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bill/calculate?u=1');

        $this->assertEquals(1, $crawler->filter('#test-hook-id:contains("1")')->count());
    }
}
