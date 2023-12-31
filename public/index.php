<?php

use app\model\Cart;
use app\model\Product;

require_once('../vendor/autoload.php');

$router = new Router();

$router->add('/', 'GET', 'HomeController:index');
$router->add('/cart', 'GET', 'CartController:index');
$router->init();

session_start();

$products = [
  1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000.00, 'quantity' => 1],
  2 => ['id' => 2, 'name' => 'mouse', 'price' => 100.00, 'quantity' => 1],
  3 => ['id' => 3, 'name' => 'teclado', 'price' => 10.00, 'quantity' => 1],
  4 => ['id' => 4, 'name' => 'monitor', 'price' => 5000.00, 'quantity' => 1],
];

if (isset($_GET['id'])) {
  $id = strip_tags($_GET['id']);
  $productInfo = $products[$id];
  $product = new Product;
  $product->setId($productInfo['id']);
  $product->setName($productInfo['name']);
  $product->setPrice($productInfo['price']);
  $product->setQuantity($productInfo['quantity']);

  $cart = new Cart;
  $cart->add($product);
}

var_dump($_SESSION['cart'] ?? []);

?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <a href="MyCart.php">Go to cart</a>
  <ul>
    <?php foreach ($products as $product): ?>
      <li> 
       <?= ucfirst($product['name']); ?> | <a href="?id=<?=$product['id'];?>">Add</a>
       R$ <?= number_format($product['price'], 2, ',', '.'); ?> 
      </li>
    <?php endforeach; ?>
  </ul>
</body>

</html> -->