<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 21.09.2017
 * Time: 16:17
 */

namespace App\Http\ViewComposers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\ViewComposers\LeftColumnComposer as LeftColumn;

class LeftColumnComposer extends LeftColumn
{
	/**
	 * Left column config array
	 *
	 * @var array
	 */
	protected $leftColumnItems = [

		'partners' => [
			'name' => 'admin.partners.index',
			'pattern' => 'admin.partners',
		],

		'clients' => [
			'name' => 'admin.clients.index',
			'pattern' => 'admin.clients',
		],

		'settings' => [
			'name' => 'admin.settings.index',
			'pattern' => 'admin.settings',
		],
		'decors' => [
			'name' => 'admin.decors.index',
			'pattern' => 'admin.decors',
		],
	];

	public function __construct(Route $route)
	{
		parent::__construct($route);
	}
}