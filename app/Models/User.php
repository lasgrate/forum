<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'role'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Relation between users and forums (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function forums()
	{
		return $this->hasMany('App\Models\Forum');
	}

	/**
	 * Relation between users and themes (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function themes()
	{
		return $this->hasManyThrough('App\Models\Theme', 'App\Models\Forum');
	}

	/**
	 * Relation between users and tags (one to many manythrough)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function tags()
	{
		return $this->hasManyThrough('App\Models\Tag', 'App\Models\Forum');
	}

	/**
	 * Relation between users and clients (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function clients()
	{
		return $this->hasManyThrough('App\Models\Client', 'App\Models\Forum');
	}
}
