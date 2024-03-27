<?php

namespace app\controllers;

use app\model\CartInfo;
use app\utils\Auth;
use app\utils\Redirect;
use Stripe\StripeClient;

class CheckoutController
{
    public function checkout()
    {

        if (!Auth::auth()) {
            throw new \Exception("To checkout you need to be logged in");
        }
        
        $private_key = $_ENV['STRIPE_PRIVATE_KEY'];

        $stripe = new StripeClient($private_key);

        $productsIncart = CartInfo::getCart();

        $baseUrl = $_ENV['BASE_URL'];

        $items = [
            'mode' => 'payment',
            'success_url' => "{$baseUrl}/success.php",
            'cancel_url' => "{$baseUrl}/cancel.php",
        ];

        foreach ($productsIncart as $product) {
            $items['line_items'][] = [
                'price_data' => [
                'currency' => 'brl',
                'product_data' => [
                    'name' => $product->getName()
                ],
                'unit_amount' => $product->getPrice() * 100
                ],
                'quantity' => $product->getQuantity()
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create($items);

        header("HTTP/1.1 303 See Other");
        Redirect::to($checkout_session->url);
    }
}