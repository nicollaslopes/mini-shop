<?php

use route\Router;

require_once('../vendor/autoload.php');
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

try {
  $router = new Router();
  $router->add('/', 'GET', 'HomeController:index');
  $router->add('/cart', 'GET', 'CartController:index');
  $router->add('/cart/add', 'GET', 'CartController:add');
  $router->add('/cart/remove', 'GET', 'CartController:destroy');
  $router->add('/cart/update', 'POST', 'CartController:update');
  $router->add('/login', 'GET', 'LoginController:index');
  $router->add('/login', 'POST', 'LoginController:store');
  $router->init();
} catch (Exception $e) {
  var_dump($e->getMessage());
}


// $products = [
//   1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000.00, 'quantity' => 1],
//   2 => ['id' => 2, 'name' => 'mouse', 'price' => 100.00, 'quantity' => 1],
//   3 => ['id' => 3, 'name' => 'teclado', 'price' => 10.00, 'quantity' => 1],
//   4 => ['id' => 4, 'name' => 'monitor', 'price' => 5000.00, 'quantity' => 1],
// ];



// var_dump($_SESSION['cart'] ?? []);

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