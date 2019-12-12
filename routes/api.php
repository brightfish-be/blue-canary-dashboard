<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router = app('router');

$router->group(['prefix' => 'v1'], function (Router $router) {

    # Guest routes
    $router->post('auth/login', 'Auth\LoginController@login');

    # Authenticated routes
    $router->group(['middleware' => 'jwt.auth'], function (Router $router) {

        # Authentication
        $router->group(['prefix' => 'auth'], function (Router $router) {
            $router->post('logout', 'Auth\LoginController@logout');
            $router->post('refresh', 'Auth\LoginController@refresh');
            $router->get('me', 'Auth\LoginController@user');
        });

        # CRUDs
        $router->apiResource('apps', 'AppsController');
        $router->apiResource('apps.counters', 'CountersController');
    });
});

# Catch all fallback
$router->get('{path}', 'Controller@api404')->where('path', '(.*)');
