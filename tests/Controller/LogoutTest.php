<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogoutTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }

    public function testSuccessfulLogout(): void
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'user1@example.com',
            '_password' => 'password123',
        ]);
        $this->client->submit($form);

        $this->assertResponseRedirects('/');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', "Vous êtes connecté");

        $crawler = $this->client->request('GET', '/');
        $link = $crawler->selectLink('Logout')->link();
        $this->client->click($link);

        $this->assertResponseRedirects('/');
        $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', "Vous n'êtes pas connecté");
    }
}
