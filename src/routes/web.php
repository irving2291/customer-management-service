<?php
use Laravel\Lumen\Routing\Router;
/** @var Router $router */
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

$router->get('/test', 'ExampleController@test');

$router->post('/information-request-listen', 'InformationRequestsController@listen');
$router->get('/information-request', 'InformationRequestsController@index');

$router->post('/language', 'LanguageController@store');

$router->post('/register','UsersController@register');
