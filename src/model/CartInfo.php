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
    return $_SESSION['cart']['total'] ?? 0;
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