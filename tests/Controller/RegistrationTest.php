<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    private $client;
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->entityManager = self::getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown(): void
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'user1@example.com']);

        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }

        $this->client = null;
        $this->entityManager = null;
        parent::tearDown();
    }

    public function testRenderRegisterPage()
    {
        $this->client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorTextContains('h1', 'Register');
    }

    public function testSuccessfulRegister()
    {
        $crawler = $this->client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        $form = $crawler->selectButton('Register')->form([
            'registration_form[firstName]' => 'firstname1',
            'registration_form[lastName]' => 'lastname1',
            'registration_form[email]' => 'user1@example.com',
            'registration_form[plainPassword]' => 'password123',
        ]);
        $this->client->submit($form);

        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');
        $this->client->followRedirect();

        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => 'user1@example.com']);

        $this->assertNotNull(
            $user,
            'User is not created in the database.'
        );
        $this->assertEquals(
            'firstname1',
            $user->getFirstname(),
            'Firstname is not the same as the one entered.'
        );
        $this->assertEquals(
            'lastname1',
            $user->getLastname(),

            'Lastname is not the same as the one entered.'
        );
    }
}
