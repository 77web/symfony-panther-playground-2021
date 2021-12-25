<?php
declare(strict_types=1);

namespace App\Tests\Controller\DefaultController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VendorsTest extends WebTestCase
{
    public function testGoogle()
    {
        $client = static::createClient();
        $client->request('GET', '/vendors/search');

        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);
        $this->assertCount(2, $data);
        $this->assertEquals([
            ['name' => 'google', 'caption' => 'Google広告'],
            ['name' => 'yahoo', 'caption' => 'Yahoo広告'],
        ], $data);
    }
}
