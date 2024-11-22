<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
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

  public function testLoginPageIsRender(): void
  {
    $this->client->request('GET', '/login');
    $this->assertResponseStatusCodeSame(200);
    $this->assertSelectorTextContains('h1', 'Please sign in');
  }

  public function testSuccessfulLogin(): void
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
  }

  public function testWrongLogin(): void
  {
    $crawler = $this->client->request('GET', '/login');
    $form = $crawler->selectButton('Sign in')->form([
      '_username' => 'wrong@example.com',
      '_password' => 'wrongpassword',
    ]);

    $this->client->submit($form);

    $this->assertResponseRedirects('/login');
    $this->client->followRedirect();
  }
}
