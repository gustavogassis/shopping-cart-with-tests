<?php

declare(strict_types=1);

namespace App;

use App\Product;
use InvalidArgumentException;

class Item
{
    private Product $product;
    private int $quantity;
    private float $discount;

    public function __construct(Product $product, int $quantity, float $discount)
    {
        $this->product = $product;
        $this->setQuantity($quantity);
        $this->setDiscount($discount);
    }

    public function totalPrice(): float
    {
        return $this->product->price() * $this->quantity * (1 - $this->discount);
    }

    public function description(): string
    {
        return $this->product->description();
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function discount(): float
    {
        return $this->discount;
    }

    public function setQuantity(int $quantity): void
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException("Um item deve ter pelo menos uma unidade.");
        }

        $this->quantity = $quantity;
    }

    public function setDiscount(float $discount): void
    {
        if ($discount < 0) {
            throw new InvalidArgumentException("O desconto não pode ser um valor negativo.");
        }

        $this->discount = $discount;
    }
}
