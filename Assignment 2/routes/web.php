<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// $router->post('/register','AuthController@register');
$router->post('/login', 'AuthController@login');
$router->post('/register','UserController@register');
$router->post('/post', 'PostController@store');
$router->delete('/post/delete/{post}', 'PostController@destroy');
$router->patch('post/edit/{post}','PostController@edit');

$router->post('post/reply','PostController@reply');




$router->group(['prefix' => 'api', 'middleware' => 'auth'], function() use ($router){
   $router->post('/me','AuthController@me');
    $router->post('/logout', 'AuthController@logout');
});
