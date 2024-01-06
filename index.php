<?php
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();
$container->register('string_helper', 'app\core\StringHelper');
$container->register('app_request', 'app\core\request\AppRequest')
          ->addArgument(new Reference('string_helper'));
$container->register('app_router', 'app\core\router\AppRouter')
          ->addArgument(new Reference('app_request'));
$container->register('application', 'app\core\Application')
          ->addArgument(new Reference('app_router'));
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
