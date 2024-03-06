<?php

use DataBase\DB;

spl_autoload_register(function (string $class){
    $documentRoot = './src/';
    include $documentRoot . $class . '.php';
}, true);

$db = new DB('localhost', 'books', 'root', '');

/**
 * @var DB $db
 */

print_r($db->getBooks());
$db->deleteBooks(13);
$db->deleteBooks(14);
?>