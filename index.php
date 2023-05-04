<?php

namespace App;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/apiHeaders.php';

use Bramus\Router\Router;



$router = new Router();

$router->post('/api/vi/register', "\App\Controllers\UserRegisterController@index");
$router->before("POST", '/api/vi/register', "\App\Controllers\UserRegisterController@valiateBody");


$router->post('/api/vi/auth', "\App\Controllers\UserAuthController@index");
$router->before("POST", '/api/vi/auth', "\App\Controllers\UserAuthController@valiateBody");

$router->post('/api/vi/auth-token', "\App\Controllers\UserAuthTokenController@index");
$router->before("POST", '/api/vi/auth-token', "\App\Controllers\UserAuthTokenController@valiateBody");

$router->post('/api/vi/update-profile', "\App\Controllers\UserProfileUpdateController@index");
$router->before("POST", '/api/vi/update-profile', "\App\Controllers\UserProfileUpdateController@valiateBody");


$router->get('/', function(){
    header('Content-Type: text/html; charset=utf-8');
    require __DIR__ . '/front/index.php';
});

$router->get('/register', function(){
    header('Content-Type: text/html; charset=utf-8');
    require __DIR__ . '/front/index.php';
});

$router->get('/auth', function(){
    header('Content-Type: text/html; charset=utf-8');
    require __DIR__ . '/front/index.php';
});

$router->get('/profile', function(){
    header('Content-Type: text/html; charset=utf-8');
    require __DIR__ . '/front/index.php';
});

$router->run();

