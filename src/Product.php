<?php

declare(strict_types=1);

namespace App;

class Product
{
    private int $id;
    private string $description;
    private float $price;

    public function __construct(int $id, string $description, float $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
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
}
