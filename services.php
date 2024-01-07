<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->parameters()
    //... 
    ;

    $services = $container->services();

    $services->set('string_helper', 'app\core\StringHelper')
    ;
    $services->set('view_manager', 'app\core\ViewManager')
        ->args([service('string_helper')])
    ;
    $services->set('app_request', 'app\core\request\AppRequest')
        ->args([service('string_helper')])
    ;
    $services->set('app_router', 'app\core\router\AppRouter')
        ->args([service('app_request'), service('view_manager')])
    ;
    $services->set('application', 'app\core\Application')
        ->args([service('app_router')])
    ;

};