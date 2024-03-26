<?php

namespace app\controllers;

use app\model\User;
use app\utils\Auth;
use app\utils\Redirect;
use app\views\View;
use Exception;

class LoginController
{
    public function index()
    {
        return View::render('/login');
    }

    public function store()
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $user = User::where('email', $email);

        if (!$user) {
            throw new Exception('Email or password is invalid!');
        }

        if (!password_verify($password, $user->password)) {
            throw new Exception('Email or password is invalid!');
        }

        Auth::loginAs($user);

        Redirect::to('/');
    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::back();
    }
}