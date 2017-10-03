<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 24.09.2017
 * Time: 20:09
 */

namespace App\Http\ViewComposers\Partner;

use \App\Models\User;
use Illuminate\View\View;

class HeaderComposer
{
	/**
	 * Bind data to the view.
	 *
	 * @param  View $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$user_id = auth('user')->id();

		$newMessages = User::findOrFail($user_id)
			->themes()
			->leftJoin('messages', 'messages.theme_id', '=', 'themes.id')
			->where('messages.user_view', '=', false)
			->count();

		$view->with([
			'newMessages' => $newMessages,
		]);
	}
}