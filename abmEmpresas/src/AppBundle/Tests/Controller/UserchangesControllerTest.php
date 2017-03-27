<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserchangesControllerTest extends WebTestCase
{
    public function testUserchange()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/userChange');
    }

}
