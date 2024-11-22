<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\Calculator;
use App\Entity\Product;

class CalculatorTest extends TestCase
{
  private Calculator $calculator;

  protected function setUp(): void
  {
    $this->calculator = new Calculator();
  }

  private function createProduct(float $price, string $name): Product
  {
    $product = new Product();
    $product->setPrice($price);
    $product->setName($name);
    return $product;
  }

  public function testGetTotalHT(): void
  {
    $products = [
      ['product' => $this->createProduct(10, "Ballon rouge"), 'quantity' => 2],
      ['product' => $this->createProduct(10, "Ballon bleu"), 'quantity' => 1],
      ['product' => $this->createProduct(5, "Ballon jaune"), 'quantity' => 2],
    ];

    $result = $this->calculator->getTotalHT($products);
    $this->assertEquals(40.0, $result, 'Total HT devrait être 40.0');
  }

  public function testGetTotalTTC(): void
  {
    $products = [
      ['product' => $this->createProduct(10, "Ballon rouge"), 'quantity' => 2],
      ['product' => $this->createProduct(10, "Ballon bleu"), 'quantity' => 1],
      ['product' => $this->createProduct(5, "Ballon jaune"), 'quantity' => 2],
    ];

    $result = $this->calculator->getTotalTTC($products, 20.0);
    $this->assertEquals(48.0, $result, 'Total TTC devrait être 48.0 avec 20% TVA');
  }
}
