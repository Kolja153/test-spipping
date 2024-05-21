<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShippingControllerTest extends WebTestCase
{
    public function testCalculateTransCompany()
    {
        $client = static::createClient();
        $client->request('POST', '/api/calculate', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'weight' => 5,
            'carrier' => 'trans_company'
        ]));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(20, $data['cost']);
    }

    public function testCalculatePackGroup()
    {
        $client = static::createClient();
        $client->request('POST', '/api/calculate', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'weight' => 15,
            'carrier' => 'pack_group'
        ]));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(15, $data['cost']);
    }

    public function testInvalidCarrier()
    {
        $client = static::createClient();
        $client->request('POST', '/api/calculate', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'weight' => 5,
            'carrier' => 'invalidcarrier'
        ]));

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('Carrier could not be found.', $data);
    }
}
