<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewCompanyControllerTest extends WebTestCase
{
    public function testNewcompany()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newCompany');
    }

}
