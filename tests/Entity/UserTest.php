<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
  public function testUserProperties()
  {
    $user = new User();
    
    $user->setFirstname("John");
    $this->assertEquals("John", $user->getFirstname());

    $user->setLastname("Doe");
    $this->assertEquals("Doe", $user->getLastname());

    $user->setEmail("john@doe.com");
    $this->assertEquals("john@doe.com", $user->getEmail());
    $this->assertEquals('john@doe.com', $user->getUserIdentifier());

    $user->setPassword("123456789");
    $this->assertEquals("123456789", $user->getPassword());

    $user->setRoles(["ROLE_USER"]);
    $this->assertEquals(["ROLE_USER"], $user->getRoles());
  }
}
