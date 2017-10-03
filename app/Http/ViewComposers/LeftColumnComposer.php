<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 21.09.2017
 * Time: 16:22
 */

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

abstract class LeftColumnComposer
{
	/**
	 * Current route
	 *
	 * @var
	 */
	protected $currentRouteName;

	/**
	 * Array of left column items
	 *
	 * @var
	 */
	protected $leftColumnItems = [];

	public function __construct(Route $route)
	{
		$this->currentRouteName = $route::currentRouteName();
	}

	public function createLeftColumnArray()
	{
		foreach ($this->leftColumnItems as $item => &$route) {
			$route['active'] = preg_match('/' . preg_quote($route['pattern']) . '/', $this->currentRouteName) ? true : false;
		}
	}

	public function compose(View $view)
	{
		$this->createLeftColumnArray();

		$view->with([
			'leftColumnItems' => $this->leftColumnItems,
		]);

	}
}