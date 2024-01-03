<?php

use app\model\Cart;
use Stripe\StripeClient;

require_once('../vendor/autoload.php');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

session_start();

$private_key = $_ENV['STRIPE_PRIVATE_KEY'];

$stripe = new StripeClient($private_key);

$cart = new Cart;
$productsIncart = $cart->getCart();

$items = [
  'mode' => 'payment',
  'success_url' => 'http://localhost:8000/success.php',
  'cancel_url' => 'http://localhost:8000/cancel.php',
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
header("Location: " . $checkout_session->url);