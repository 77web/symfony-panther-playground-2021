<?php
declare(strict_types=1);

namespace App\Tests\Controller\PrivateController;

use App\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Component\Panther\PantherTestCase;

class IndexPantherTest extends PantherTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $client = static::createPantherClient();

        $databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $databaseTool->loadAliceFixture([__DIR__.'/../../fixtures/user.yaml']);

        static::ensureKernelShutdown();
    }

    public function testMember()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'member-email@quartetcom.co.jp';
        $form['password'] = 'password';
        $client->submit($form);

        $client->request('GET', '/private');
        $this->assertSelectorTextContains('body', 'member-email@quartetcom.co.jp');

        $client->request('GET', '/logout');
    }

    public function testNonMember()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/private');
        $this->assertTrue(str_contains($crawler->getUri(), '/login'), $crawler->getUri()); // $client->getResponse() is not available in PantherClient
    }
}
