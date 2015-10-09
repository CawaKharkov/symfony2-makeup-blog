<?php
/**
 * Created by PhpStorm.
 * User: cawa
 * Date: 10/9/15
 * Time: 7:03 PM
 */

namespace AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
       // $this->assertContains('Dashboard', $crawler->filter('#container h1')->text());
    }
}
