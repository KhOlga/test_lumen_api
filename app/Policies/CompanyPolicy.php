<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CompanyPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user, Company $companies)
	{
		if (Auth::check()) {
			//$companies = $user->companies()->get();

			foreach ($companies as $company) {
				if ($user->id === $company->pivot->user_id) {
					return Response::allow();
				}
			}

			return Response::deny('You do not own this information.');
		}
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function create(User $user)
	{
		return Auth::check();
	}
}
