<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/* /api/user/register */
	public function register(Request $request)
	{
		//   first_name
		//   last_name
		//   email
		//   password
		//   phone

		$credentials = request(['email', 'password']);

		$validated = $this->validate($request, [
			'first_name' => 'required|string|max:50',
			'last_name' => 'required|string|max:50',
			'email' => 'required|email|unique:users',
			'password' => 'required|string|max:6',
			'phone' => 'required|string|max:20', // The phone length depends on country.
		]);
	}

	/* /api/user/sign-in */
	public function signIn()
	{
		//   email
		//   password
	}

	/* /api/user/recover-password */
	public function recoverPassword()
	{
		//   email
	}
}
