<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();
$loader = new PhpFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.php');
$app = $container->get('application');

// Define routes
$app->router->get('/', function () {
    echo 'Index page';
});
$app->router->get('/posts', function () {
    echo 'Posts';
});
$app->router->post('/posts', function () {
    echo 'Add post';
});

$app->run();
