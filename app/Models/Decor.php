<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
        'name', 'colors'
    ];


    public function forums()
    {
        return $this->hasMany('App\Models\Forum');
    }

    public $timestamps = false;

}
