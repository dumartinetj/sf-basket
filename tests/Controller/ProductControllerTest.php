<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/products');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(12, $crawler->filter(".productItem")->count());
    }

    public function testShow()
    {
        $client = static::createClient();

        $client->request('GET', '/product/test123');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());


        $crawler = $client->request('GET', '/product/harry-potter-a-l-ecole-des-sorciers');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


}