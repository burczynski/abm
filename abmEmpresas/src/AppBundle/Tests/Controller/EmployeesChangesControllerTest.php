<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeesChangesControllerTest extends WebTestCase
{
    public function testEmployeechange()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/employeeChange');
    }

}
