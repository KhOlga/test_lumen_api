<?php

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RecoverPasswordController;
use App\Http\Controllers\User\RegisterUserController;

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

$router->group(['prefix' => 'api', 'as' => 'api.v1', 'namespace' => 'API'], function () use ($router) {
	$router->group(['prefix' => 'user', 'as' => 'user', 'namespace' => 'User', 'middleware' => 'guest'],
		function () use ($router) {
			$router->get('register', [RegisterUserController::class, 'create', 'as' => 'create']);
			$router->post('register', [RegisterUserController::class, 'store', 'as' => 'store']);

			$router->get('sign-in', [LoginController::class, 'create', 'as' => 'login']);
			$router->post('sign-in', [LoginController::class, 'store', 'as' => 'login_store']);

			$router->post('recover-password', [
				RecoverPasswordController::class, 'recoverPassword', 'as' => 'recover_password'
			]);

			$router->get('companies', [CompanyController::class, 'index', 'as' => 'index']);
			$router->post('companies', [CompanyController::class, 'store', 'as' => 'store']);
	});
});