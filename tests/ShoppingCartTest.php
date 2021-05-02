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

        $expectedMessage = "Não é possível remover o item com o produto Suco de Laranja pois " .
            "ele não encontra-se no carrinho de compras.";

        $this->expectException(ShoppingCartException::class);
        $this->expectExceptionMessage($expectedMessage);

        $shoppingCart->removeItem($item2);
    }

    public function testGetTotalPrice(): void
    {
        $discountProduct1 = 0.2;
        $product1 = new Product(1, 'X-Bacon', 20);
        $product2 = new Product(2, 'Suco de Laranja', 8);

        $item1 = new Item($product1, 2, $discountProduct1);
        $item2 = new Item($product2, 1, 0);

        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);
        $shoppingCart->addItem($item2);

        $totalPrice = $shoppingCart->getTotalPrice();

        $this->assertEquals(40, $totalPrice);
    }

    public function testAddAnItemWhenThereAreFiveItemsOnShoppingCartShoulThrowAnException(): void
    {
        $product1 = new Product(1, 'Suco de Laranja', 8.0);
        $product2 = new Product(2, 'X-Bacon', 20.0);
        $product3 = new Product(3, 'Snickers', 3.5);
        $product4 = new Product(4, 'Sorvete Picolé', 2.0);
        $product5 = new Product(5, 'Hot-Dog', 12.0);
        $product6 = new Product(6, 'Caldo de Cana', 7.0);

        $item1 = new Item($product1, 2, 0);
        $item2 = new Item($product2, 2, 0);
        $item3 = new Item($product3, 2, 0);
        $item4 = new Item($product4, 2, 0);
        $item5 = new Item($product5, 2, 0);
        $item6 = new Item($product6, 2, 0);

        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);
        $shoppingCart->addItem($item2);
        $shoppingCart->addItem($item3);
        $shoppingCart->addItem($item4);
        $shoppingCart->addItem($item5);

        $expectedMessage = "O carrinho de compra só pode conter no máximo 5 itens.";

        $this->expectException(ShoppingCartException::class);
        $this->expectExceptionMessage($expectedMessage);

        $shoppingCart->addItem($item6);
    }

    public function testAddAnExistentItemInTheShoppingCartShouldThrowAnException(): void
    {
        $product1 = new Product(1, 'Suco de Laranja', 8.0);
        $product2 = new Product(2, 'X-Bacon', 20.0);

        $item1 = new Item($product1, 2, 0);
        $item2 = new Item($product2, 2, 0);

        $shoppingCart = new ShoppingCart();
        $shoppingCart->addItem($item1);
        $shoppingCart->addItem($item2);

        $expectedMessage = "Não é possível adicionar o item com o produto Suco de Laranja pois " .
            "ele já existe no carrinho de compras.";

        $this->expectException(ShoppingCartException::class);
        $this->expectExceptionMessage($expectedMessage);

        $shoppingCart->addItem($item1);
    }
}
