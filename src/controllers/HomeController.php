<?php

namespace app\controllers;

use app\model\Product;
use app\model\User;
use app\views\View;

class HomeController
{
    public function index()
    {
        $products = Product::all('id,name,price, image');

        View::render('home', ['products' => $products]);
    }
}