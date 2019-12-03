<?php

use Illuminate\Routing\Router;

app('router')->group([], function (Router $router) {

    # Health pinging
    $router->get('health', 'Controller@health');

    # Default catch all
    $router->get('{path}', 'Controller@layout')->where('path', '(.*)');
});
