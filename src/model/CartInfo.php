<?php

namespace app\model;

use app\model\Product;

class CartInfo
{

  public static function getCart()
  {
    return $_SESSION['cart']['products'] ?? [];
  }

  public static function getTotal()
  {
    $total = 0;

    if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart']['products'] as $product) {
        $total += $product->getPrice() * $product->getQuantity();
      }
    }
    
    return $total;
  }

  public static function getQuantity(Product $product)
  {
    if (isset($_SESSION['cart']['products']) && array_key_exists($product->getSlug(), $_SESSION['cart']['products'])) {
        return $_SESSION['cart']['products'][$product->getSlug()]->getQuantity();
    }
  }

  public static function getTotalProductsInCart()
  {
    return count(self::getCart());
  }
}