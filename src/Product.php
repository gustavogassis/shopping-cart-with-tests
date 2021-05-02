<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class Product
{
    private int $id;
    private string $description;
    private float $price;

    public function __construct(int $id, string $description, float $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->setPrice($price);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        if ($price <= 0) {
            throw new InvalidArgumentException("O preço de um produto não ser zero ou negativo.");
        }

        $this->price = $price;
    }
}
