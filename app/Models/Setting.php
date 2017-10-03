<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 10.09.2017
 * Time: 18:14
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'value',
	];

}