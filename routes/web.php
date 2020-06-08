<?php

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


$router->get('exs', 'ReportController@showExs');
$router->get('exlist', 'ExsController@getExs');


$router->get('tipologies', 'NewExController@showTips');
$router->get('newEx', 'NewExController@newExToDB');

$router->get('selected', 'ReportController@getExsFromIds');


//$router->get('report/pdf', 'ReportController@pdf'); // test this


$router->get('register', 'RegisterController@registerToDB');

$router->get('login', 'LoginController@login');
//$router->get('selected/{begin}/{end}', 'ReportController@getExsFromIds');


//$router->get('generatepdf', 'ReportController@pdf'); 