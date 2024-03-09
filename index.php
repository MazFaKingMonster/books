<?php

use DataBase\DB;

/**
 * @var DB $db
 */

spl_autoload_register(function (string $class){
    $documentRoot = './src/';
    include $documentRoot . $class . '.php';
}, true);

$db = new DB('localhost', 'books', 'root', '');
$session_manager = new BookSessionManager();
$catalog = new Catalog($db, $session_manager);

?>