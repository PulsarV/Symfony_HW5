<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;

class TeamControllerTest extends TestBaseWeb
{
    public function testView()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/team/view/Ukraine');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Ukraine national football team', $crawler->filter('h1')->text());

        $client->request('GET', "/team/view/Ukraine-Ukraine Ukraine.Ukraine'");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/team/view/Ukraine1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/team/view/Ukraine/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
