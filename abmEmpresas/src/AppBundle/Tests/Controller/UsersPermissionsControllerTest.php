<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersPermissionsControllerTest extends WebTestCase
{
    public function testNewuserspermissions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newUsersPermissions');
    }

}
