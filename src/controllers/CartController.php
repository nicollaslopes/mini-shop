<?php

namespace app\controllers;

use app\model\Cart;
use app\model\Product;
use app\utils\Redirect;
use app\views\View;

class CartController
{
    public function index()
    {
        View::render('cart');
    }

    public function add()
    {
        if (isset($_GET['id'])) {
            $id = strip_tags($_GET['id']);

            $productInfo = Product::where('id', $id);

            $product = new Product;
            $product->setId($productInfo->id);
            $product->setSlug($productInfo->slug);
            $product->setName($productInfo->name);
            $product->setPrice($productInfo->price);
            $product->setQuantity(1);

            $cart = new Cart;
            $cart->add($product);

            Redirect::back();
        }
    }
}