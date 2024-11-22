<?php

namespace App\Service;

class Calculator
{
  public function getTotalHT(array $productsWithQuantities): float
  {
    return array_reduce(
      $productsWithQuantities,
      fn(float $total, array $item) => $total + ($item['product']->getPrice() * $item['quantity']),
      0.0
    );
  }

  public function getTotalTTC(array $productsWithQuantities, float $tva): float
  {
    $totalHT = $this->getTotalHT($productsWithQuantities);
    return $totalHT * (1 + $tva / 100);
  }
}

