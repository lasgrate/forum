<?php

namespace App\Http\Controllers\Client;

use App\Models\Theme;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth.redirect');
	}

	public function store(Request $request, $forum_id)
	{
		$this->validate($request, [
			'text' => 'required|max:10000',
		]);

		$theme = Theme::findBySlugOrFail($request->slug);

		if ($theme->client && $theme->client->id == auth()->id()) {
			$client_view = true;
		} else {
			$client_view = false;
		}

		Message::create([
			'client_id' => auth()->id(),
			'theme_id' => $theme->id,
			'text' => $request->text,
			'is_enable' => false,
			'client_view' => $client_view,
			'user_view' => false,
		]);

		return redirect()->route('theme.show', [
			'forum_id' => $forum_id,
			'slug' => $theme->slug]);
	}
}
