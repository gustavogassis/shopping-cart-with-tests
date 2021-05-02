<?php

declare(strict_types=1);

require_once "../vendor/autoload.php";

ini_set('display_errors', '1');
error_reporting(E_ALL);

use App\Product;
use App\Item;
use App\ShoppingCart;

$product1 = new Product(1, 'X-Bacon', 20);
$product2 = new Product(2, 'Suco de Laranja', 8);

$item1 = new Item($product1, 2, 0);
$item2 = new Item($product2, 1, 0);

$shoppingCart = new ShoppingCart();
$shoppingCart->addItem($item1);
$shoppingCart->addItem($item2);

print_r($shoppingCart->listItems());
