<?php

declare(strict_types=1);

namespace App;

use Exception;

class ShoppingCartException extends Exception
{
    public static function forAnExistentItem(Item $item): self
    {
        return new static(sprintf(
            "Não é possível adicionar o item com o produto %s pois ele já existe no carrinho de compras.",
            $item->description()
        ));
    }

    public static function forMaximumNumberOfItems(int $maximumNumberOfItems): self
    {
        return new static(sprintf(
            "O carrinho de compra só pode conter no máximo %d itens.",
            $maximumNumberOfItems
        ));
    }

    public static function forANonExistentItem(Item $item): self
    {
        return new static(sprintf(
            "Não é possível remover o item com o produto %s pois ele não encontra-se no carrinho de compras.",
            $item->description()
        ));
    }
}
