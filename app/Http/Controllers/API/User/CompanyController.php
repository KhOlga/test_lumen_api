<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
	/* /api/user/companies */
	public function index()
	{
		$user = \App\Models\User::where('id', 7)->first();
		/*$user = Auth::user();*/

//		if ($user->cannot('viewAny', Company::class)) {
//			return response()->json(403);
//		}

		if ($user->can('viewAny', Company::class)) {

			$companies = $user->companies()->get();

			foreach ($companies as $company) {
				$data[$company->id]['title'] = $company->title;
				$data[$company->id]['phone'] = $company->phone;
				$data[$company->id]['description'] = $company->description;
			}

			return response()->json($data);
		}

		return response()->json(403);
	}

	/* /api/user/companies */
	public function store(Request $request)
	{
		$user = $request->user();

		if ($user->cannot('create', Company::class)) {
			//return response()->json(403);
			return response()->json([
				'message' => 'Something wrong',
			]);
		}

		if ($user->can('create', Company::class)) {
			$validated = $this->validate($request, [
				'title' => 'required|string|max:50',
				'phone' => 'required|string|max:20', // The phone length depends on country.
				'description' => 'required|string|max:255'
			]);

			$company = Company::create($validated);

			CompanyUser::create([
				'user_id' => $user->id,
				'company_id' => $company->id,
			]);

			return response()->json(201);
		}
	}
}
