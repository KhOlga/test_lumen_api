<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the API routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterUserController;

$router->group(['prefix' => 'api/v1', 'as' => 'api.v1', 'namespace' => 'API\\V1'], function () use ($router) {
	$router->group(['prefix' => 'user', 'as' => 'user', 'namespace' => 'User', 'middleware' => 'guest'],
		function () use ($router) {
			$router->get('register', [RegisterUserController::class, 'create', 'as' => 'create']);
			$router->post('register', [RegisterUserController::class, 'store', 'as' => 'store']);

			$router->get('sign-in', [LoginController::class, 'create', 'as' => 'login']);

			$router->post('sign-in', [LoginController::class, 'store', 'as' => 'login_store']);

			$router->get('/', function () use ($router) {
				return $router->app->version();
			});
	});
});