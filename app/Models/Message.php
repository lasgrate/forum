<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
		'text',
		'client_id',
		'is_enable',
		'theme_id',
		'fake_name',
		'client_view',
		'user_view',
		'created_at',
	];

	/**
	 * Relation between themes and messages (one to many inverse)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theme()
	{
		return $this->belongsTo('App\Models\Theme');
	}

	/**
	 * Relation between client and messages (one to many inverse)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}
}
