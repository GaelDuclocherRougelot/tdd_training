<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Order;
use App\Entity\User;

class OrderTest extends TestCase
{
  public function testOrderProperties()
  {
    $order = new Order();
    $user = new User();
    $user->setEmail('test@example.com');
    $order->setUser($user);


    $this->assertSame($user, $order->getUser());


    $this->assertEquals('test@example.com', $order->getUser()->getEmail());

    $order->setNumber("123456789");
    $this->assertEquals("123456789", $order->getNumber());

    $order->setTotalPrice(2999.99);
    $this->assertEquals(2999.99, $order->getTotalPrice());
  }
}
