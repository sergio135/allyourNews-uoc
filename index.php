<?php
require './vendor/autoload.php';
$app = new \Slim\App;
$container = $app->getContainer();

// Añadir dependencias
$container['view'] = new \Slim\Views\PhpRenderer('./src/views/');

require './src/routes/index.php';
require './src/api/index.php';

$app->run();
?>