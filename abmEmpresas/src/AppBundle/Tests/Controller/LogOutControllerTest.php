<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogOutControllerTest extends WebTestCase
{
    public function testLogout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logOut');
    }

}
