<?php
declare(strict_types=1);

namespace App\Tests\Controller\DefaultController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TypesTest extends WebTestCase
{
    public function test()
    {
        $client = static::createClient();
        $client->request('GET', '/vendorTypes');

        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);
        $this->assertCount(3, $data);
        $this->assertEquals([
            'search',
            'display',
            'sns',
        ], $data);
    }
}
