<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewUsersRoleControllerTest extends WebTestCase
{
    public function testNewusersrole()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newUsersRole');
    }

}
