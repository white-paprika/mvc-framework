<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

define('ROOT_DIRECTORY', dirname(__DIR__));

require_once ROOT_DIRECTORY . '/vendor/autoload.php';

$container = new ContainerBuilder();
$loader = new PhpFileLoader($container, new FileLocator(__DIR__));
$loader->load('../services.php');

$app = $container->get('application');

// Define routes
$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->router->get('/posts', function () {
    return 'Posts';
});
$app->router->post('/posts', function () {
    return 'Add post';
});
$app->router->get('/about', 'about');

$app->run();
