<?php

use Pimple\Container;
use app\core\Application;
use app\core\request\AppRequest;
use app\core\router\AppRouter;
use app\core\StringHelper;

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container();

$container['string_helper'] = function (Container $container) {
    return new StringHelper;
};
$container['app_request'] = function (Container $container) {
    return new AppRequest($container['string_helper']);
};
$container['app_router'] = function (Container $container) {
    return new AppRouter($container['app_request']);
};
$container['application'] = function (Container $container) {
    return new Application($container['app_router']);
};

$app = $container['application'];

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
