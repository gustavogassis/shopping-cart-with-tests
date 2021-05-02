<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class ItemTest extends TestCase
{
    public function testCreateAnItemWithNegativeQuantityShouldThrowAnException(): void
    {
        $product = new Product(1, 'X-Bacon', 20);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Um item não pode ter uma quantidade menor que 1");
        $item = new Item($product, -1, 0);
    }

    public function testCalculateTotalPriceWithoutDiscount(): void
    {
        $discount = 0.0;
        $product = new Product(1, 'X-Bacon', 20);
        $item = new Item($product, 2, $discount);

        $totalPrice = $item->totalPrice();

        $this->assertEquals(40, $totalPrice);
    }

    public function testCalculateTotalPriceWithDiscount(): void
    {
        $discount = 0.2;
        $product = new Product(1, 'X-Bacon', 20);
        $item = new Item($product, 2, $discount);

        $totalPrice = $item->totalPrice();

        $this->assertEquals(32, $totalPrice);
    }
}
