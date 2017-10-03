<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 21.09.2017
 * Time: 15:20
 */

namespace App\Http\ViewComposers\Partner;

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

		'forums' => [
			'name' => 'partner.forums.index',
			'pattern' => 'partner.forums',
		],

		'themes' => [
			'name' => 'partner.themes.index',
			'pattern' => 'partner.themes',
		],

		'clients' => [
			'name' => 'partner.clients.index',
			'pattern' => 'partner.clients',
		],

		'tags' => [
			'name' => 'partner.tags.index',
			'pattern' => 'partner.tags',
		],

	];

	public function __construct(Route $route)
	{
		parent::__construct($route);
	}
}