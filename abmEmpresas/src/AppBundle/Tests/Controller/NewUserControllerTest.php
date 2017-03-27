<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewUserControllerTest extends WebTestCase
{
    public function testNewuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newUser');
    }

}
