<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'title', 'description', 'user_id', 'decor_id'
	];

	/**
	 * Relation between users and forums (one to many) inverse
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * Relation between forums and themes (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function themes()
	{
		return $this->hasMany('App\Models\Theme');
	}

	/**
	 * Relation between forums and tags (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tags()
	{
		return $this->hasMany('App\Models\Tag');
	}

	/**
	 * Relation between forums and decors (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function decor()
	{
		return $this->belongsTo('App\Models\Decor');
	}

	/**
	 * Relation between forums and clients (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function clients()
	{
		return $this->hasMany('App\Models\Client');
	}
}
