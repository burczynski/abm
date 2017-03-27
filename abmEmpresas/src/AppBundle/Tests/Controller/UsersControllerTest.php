<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testGetusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getUsers');
    }

}
