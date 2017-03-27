<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyChangesControllerTest extends WebTestCase
{
    public function testCompanychange()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/companyChange');
    }

}
