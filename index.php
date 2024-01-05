<?php

use app\core\Application;
use app\core\request\AppRequest;
use app\core\router\AppRouter;
use app\core\StringHelper;

require_once __DIR__ . '/vendor/autoload.php';

$stringHelper = new StringHelper;
$request = new AppRequest($stringHelper);
$router = new AppRouter($request);
$app = new Application($router);

// Define routes
$app->router->get('/', function(){
    echo 'Index page';
});
$app->router->get('/posts', function(){
    echo 'Posts';
});
$app->router->post('/posts', function(){
    echo 'Add post';
});

$app->run();
