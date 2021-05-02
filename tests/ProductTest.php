<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class ProductTest extends TestCase
{
    public function testCreateAProductWithNegativePriceShouldThrowAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O preço de um produto não ser zero ou negativo.");

        $product = new Product(1, 'X-Bacon', -20.0);
    }

    public function testCreateAProductWithZeroPriceShouldThrowAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O preço de um produto não ser zero ou negativo.");

        $product = new Product(1, 'X-Bacon', 0.0);
    }

    public function testCreateAProductWithValidArgumentsShouldWork(): void
    {
        $product = new Product(1, 'X-Bacon', 20.0);

        $this->assertEquals(1, $product->id());
        $this->assertEquals('X-Bacon', $product->description());
        $this->assertEquals(20.0, $product->price());
    }
}
