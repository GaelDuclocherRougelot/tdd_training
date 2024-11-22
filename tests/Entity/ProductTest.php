<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Product;

class ProductTest extends TestCase
{
  public function testProductProperties()
  {
    $product = new Product();


    $product->setName("Product 1");
    $this->assertEquals("Product 1", $product->getName());

    $product->setPrice(19.99);
    $this->assertEquals(19.99, $product->getPrice());
  }
}
