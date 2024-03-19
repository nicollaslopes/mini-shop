<?php

namespace app\controllers;

use app\views\View;

class LoginController
{
    public function index()
    {
        return View::render('/login');
    }

    public function store()
    {
    }
}