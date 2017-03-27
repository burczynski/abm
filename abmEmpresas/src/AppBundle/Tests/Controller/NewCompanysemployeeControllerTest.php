<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewCompanysemployeeControllerTest extends WebTestCase
{
    public function testNewcompanysemployee()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newCompanysemployee');
    }

}
