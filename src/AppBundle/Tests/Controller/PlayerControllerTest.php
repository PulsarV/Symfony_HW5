<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;

class PlayerControllerTest extends TestBaseWeb
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/player/view/Ukraine');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Ukraine national football team players', $crawler->filter('h1')->text());

        $client->request('GET', '/player/view/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/player/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', "/player/view/Ukraine-Ukraine Ukraine.Ukraine'");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/player/view/Ukraine1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testView()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/player/view/Ukraine/Shevchenko');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Player info Shevchenko (Ukraine)', $crawler->filter('h1')->text());

        $client->request('GET', "/player/view/Ukraine/Shevchenko-Petrenko Motrenko.Salogub'");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/player/view/Ukraine/Shevchenko1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/player/view/Ukraine/Shevchenko/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
