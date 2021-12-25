<?php
declare(strict_types=1);

namespace App\Tests\Controller\PrivateController;

use App\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexTest extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $client = static::createClient();
        $databaseTool = $client->getContainer()->get(DatabaseToolCollection::class)->get();
        $databaseTool->loadAliceFixture([__DIR__.'/../../fixtures/user.yaml']);

        static::ensureKernelShutdown();
    }

    public function testMember()
    {
        $client = static::createClient();
        $user = $client->getContainer()->get('doctrine')->getManager()->find(User::class, 1);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/private');
        $this->assertResponseIsSuccessful();
        $this->assertTrue($crawler->filter('body:contains("member-email@quartetcom.co.jp")')->count() === 1);
    }

    public function testNonMember()
    {
        $client = static::createClient();
        $client->request('GET', '/private');

        $this->assertResponseRedirects('/login');
    }
}
