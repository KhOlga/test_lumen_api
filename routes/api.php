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

$router->group(['prefix' => 'api', 'as' => 'api', 'namespace' => 'API'], function () use ($router) {
	$router->group(['prefix' => 'user', 'as' => 'user', 'namespace' => 'User', /*'middleware' => 'auth'*/],
		function () use ($router) {
			$router->post('register', ['uses' => 'UserController@register', 'as' => 'register']);
			$router->post('sign-in', [ 'uses' => 'UserController@signIn', 'as' => 'sign_in']);
			$router->post('recover-password', [
				'uses' => 'UserController@recoverPassword', 'as' => 'recover_password'
			]);

			$router->get('companies', ['uses' => 'CompanyController@index', 'as' => 'index']);
			$router->post('companies', ['uses' => 'CompanyController@store', 'as' => 'store']);
	});
});

/*
	- https://domain.com/api/user/register
	- method POST
 *
 *
	- https://domain.com/api/user/sign-in
	- method POST
 *
 *
	- https://domain.com/api/user/recover-password
	- method POST/PATCH
 *
 *
	- https://domain.com/api/user/companies
	- method GET
 *
 *
	- https://domain.com/api/user/companies
	- method POST
 *
 */


