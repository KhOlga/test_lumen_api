<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = User::class;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		/*User::factory()
			->count(10)
			->has(Company::factory()->count(3), 'companies')
			->create();*/

		/*$user = User::factory()->create();

		$companies = Company::factory()
			->count(3)
			->for($user)
			->create();*/

		User::factory()
			->hasAttached(
				Company::factory()->count(3),
			)
			->count(10)
			->create();

	}
}