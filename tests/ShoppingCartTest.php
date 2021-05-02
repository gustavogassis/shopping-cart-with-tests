<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class ShoppingCartTest extends TestCase
{
    public function testAddAnItem(): void
    {
        $product1 = new Product(1, 'X-Bacon', 20);
        $item1 = new Item($product1, 2, 0);
        $shoppingCart = new ShoppingCart();

        $shoppingCart->addItem($item1);

        $this->assertEquals(1, $shoppingCart->numberOfItems());
    }

    public function testRemoveAnItem(): void
    {
        $product1 = new Product(1, 'X-Bacon', 20);
        $item1 = new Item($product1, 2, 0);
        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);

        $shoppingCart->removeItem($item1);

        $this->assertEquals(0, $shoppingCart->numberOfItems());
    }

    public function testRemoveAnInexistentItemShouldThrowAnException(): void
    {
        $product1 = new Product(1, 'X-Bacon', 20);
        $product2 = new Product(2, 'Suco de Laranja', 8);

        $item1 = new Item($product1, 2, 0);
        $item2 = new Item($product2, 1, 0);

        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Não é possível remover um item que não está no carrinho");

        $shoppingCart->removeItem($item2);
    }

    public function testGetTotal(): void
    {
        $discountProduct1 = 0.2;
        $product1 = new Product(1, 'X-Bacon', 20);
        $product2 = new Product(2, 'Suco de Laranja', 8);

        $item1 = new Item($product1, 2, $discountProduct1);
        $item2 = new Item($product2, 1, 0);

        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);
        $shoppingCart->addItem($item2);

        $totalPrice = $shoppingCart->getTotal();

        $this->assertEquals(40, $totalPrice);
    }
}
