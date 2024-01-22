<?php

namespace app\controllers;

use app\views\View;

class CartController
{
    public function index()
    {
        View::render('cart');
    }
}