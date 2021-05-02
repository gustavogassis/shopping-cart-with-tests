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
        if ($quantity < 1) {
            throw new InvalidArgumentException("Um item não pode ter uma quantidade menor que 1");
        }

        $this->product = $product;
        $this->quantity = $quantity;
        $this->discount = $discount;
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
}
