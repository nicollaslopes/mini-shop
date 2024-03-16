<?php

namespace app\model;

use app\model\CartInfo;

class Cart
{

  public function add(Product $product)
  {
    $inCart = false;
    $this->setTotal($product);
    $cart = CartInfo::getCart();

    if (count($cart) > 0) {
      foreach ($cart as $productInCart) {
        if ($productInCart->getId() === $product->getId()) {
          $quantity = $productInCart->getQuantity() + $product->getQuantity();
          $productInCart->setQuantity($quantity);
          $inCart = true;
          break;
        }
      }
    }

    if (!$inCart) {
      $this->setProductsInCart($product);
    }
  }

  private function setProductsInCart($product)
  {
    $_SESSION['cart']['products'][$product->getSlug()]  = $product;
  }

  private function setTotal(Product $product)
  {
    $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity();
  }

  public function remove(int $id)
  {
    if (isset($_SESSION['cart']['products'])) {
      foreach (CartInfo::getCart() as $index => $product) {
        if ($product->getId() === $id) {
          unset($_SESSION['cart']['products'][$index]);
          $_SESSION['cart']['total'] -= $product->getPrice() * $product->getQuantity();
        }
      }
    }
  }
}