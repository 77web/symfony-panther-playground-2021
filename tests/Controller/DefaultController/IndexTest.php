<?php
declare(strict_types=1);

namespace App\Tests\Controller\DefaultController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

class IndexTest extends PantherTestCase
{
    public function test()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testPanther()
    {
        $client = static::createPantherClient();
        $client->request('GET', '/');

        $crawler = $client->waitForElementToContain('#type', 'search', 10);
        $this->assertCount(4, $crawler->filter('#type option'), '1+3 options in types');
        $this->assertSelectorIsDisabled('#vendor');

        $crawler->filter('#type')->children()->eq(2)->click();
        $client->takeScreenshot(__DIR__.'/../../../selectDisplayInType.png');
        $crawler = $client->waitForElementToContain('#vendor', 'Googleディスプレイ広告', 10);
        $this->assertCount(3, $crawler->filter('#vendor option'), '3 options in vendors');
        $this->assertSelectorIsEnabled('#vendor');
        $this->assertSelectorAttributeContains('#vendor option', 'value', 'gdn');
    }
}
