<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Lumen\Auth\Authorizable;

class Company extends Model
{
	use Authenticatable;
	use Authorizable;
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'phone',
		'description',
	];

	/**
	 * The users that belong to the role.
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class)->using(CompanyUser::class);
	}
}