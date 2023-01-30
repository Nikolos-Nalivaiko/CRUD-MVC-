<?php

use application\core\Router;

/* Автозагрузка классов:

*/

spl_autoload_register(function($class) {
    // Пишем переменную path, заменяем обратные слэши 
    $path = str_replace('\\','/', $class.'.php');
    // Пишем проверку если у нас существует файл с таким название то мы его подключаем
    if(file_exists($path)) require $path;
});

$router = new Router;
$router->run();