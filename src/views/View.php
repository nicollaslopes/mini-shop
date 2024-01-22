<?php

namespace app\views;

use League\Plates\Engine;
use app\model\Cart;

class View
{

    private static array $instances = [];
    
    private static function addInstances($instanceKey, $instanceClass)
    {
        if (!isset(self::$instances[$instanceKey])) {
            self::$instances[$instanceKey] = new $instanceClass;
        }
    }

    public static function render(string $view, array $data = [])
    {
        $path = dirname(__FILE__, 3);
        $filePath = $path . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

        if (!file_exists($filePath . $view . '.php')) {
            throw new \Exception("View {$view} does not exists");
        }

        self::addInstances('cart', new Cart);
        // $this->addInstances('auth', new Auth);
        // $this->addInstances('cart', new Cart);

        $templates = new Engine($filePath);
        $templates->addData(['instances' => self::$instances]);

        echo $templates->render($view, $data);

    }
}