<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeesControllerTest extends WebTestCase
{
    public function testGetemployees()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getEmployees');
    }

}
