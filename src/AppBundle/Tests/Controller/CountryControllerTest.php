<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;

class CountryControllerTest extends TestBaseWeb
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/country/view/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Countries members', $crawler->filter('h1')->text());

        $client->request('GET', '/country/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testView()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/country/view/Ukraine');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Country info Ukraine', $crawler->filter('h1')->text());

        $client->request('GET', "/country/view/Ukraine-Ukraine Ukraine.Ukraine'");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/country/view/Ukraine1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/country/view/Ukraine/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
