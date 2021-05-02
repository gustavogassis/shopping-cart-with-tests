<?php

declare(strict_types=1);

namespace App;

use App\Item;
use InvalidArgumentException;

class ShoppingCart
{

    private array $items = [];

    public function addItem(Item $item): void
    {
        array_push($this->items, $item);
    }

    public function removeItem(Item $item): void
    {
        if (!in_array($item, $this->items)) {
            throw new InvalidArgumentException("Não é possível remover um item que não está no carrinho");
        }

        $position = array_search($item, $this->items);
        unset($this->items[$position]);
    }

    public function listItems(): array
    {
        return $this->items;
    }

    public function numberOfItems(): int
    {
        return count($this->items);
    }

    public function getTotal(): float
    {
        $prices = [];

        $prices = array_map(function ($item) {
            return $item->totalPrice();
        }, $this->items);

        return array_sum($prices);
    }

    public function hasItemsOnCart(): bool
    {
        return $this->numberOfItems() > 0;
    }
}
