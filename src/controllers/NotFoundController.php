<?php

namespace app\controllers;

class NotFoundController
{
    public function index()
    {
        $response = json_encode([
            'message' => 'Controller not found',
            'success' => false
        ]);

        die(var_dump($response));
    }
}