<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanysEmployeesStatusControllerTest extends WebTestCase
{
    public function testNewcompanysemployeesstatus()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newCompanysEmployeesStatus');
    }

}
