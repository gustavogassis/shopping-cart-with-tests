<?php

declare(strict_types=1);

namespace App;

use App\Item;
use App\ShoppingCartException;

class ShoppingCart
{
    private array $items = [];
    private const MAXIMUM_NUMBER_OF_ITEMS = 5;

    public function addItem(Item $item): void
    {
        if (in_array($item, $this->items)) {
            throw ShoppingCartException::forAnExistentItem($item);
        }

        if ($this->numberOfItems() === self::MAXIMUM_NUMBER_OF_ITEMS) {
            throw ShoppingCartException::forMaximumNumberOfItems(self::MAXIMUM_NUMBER_OF_ITEMS);
        }

        array_push($this->items, $item);
    }

    public function removeItem(Item $item): void
    {
        if (! in_array($item, $this->items)) {
            throw ShoppingCartException::forANonExistentItem($item);
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

    public function getTotalPrice(): float
    {
        $prices = [];

        $prices = array_map(function ($item) {
            return $item->totalPrice();
        }, $this->items);

        return array_sum($prices);
    }

    public function isEmpty(): bool
    {
        return $this->numberOfItems() === 0;
    }
}
