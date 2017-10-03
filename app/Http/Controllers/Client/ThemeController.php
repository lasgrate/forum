<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Forum;

class ThemeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth.redirect')->except('show');
	}

	public function create($forum_id)
	{
		$forum = Forum::find($forum_id);

		return view('client.home.create_theme')->with(['forum' => $forum]);
	}

	public function show($forum_id, $slug)
	{
		$theme = new Theme();
		$theme = $theme->whereRaw('forum_id = ? and slug = ?', [$forum_id, $slug])->firstOrFail();

		if (auth()->check() && $theme->client_id == auth()->id()) {
			$theme->messages()->update(['client_view' => true]);
		}

		$forum = Forum::find($forum_id);
		$messages = $theme->messages()->paginate(20);

		return view('client.themes.show', [
			'theme' => $theme,
			'messages' => $messages,
			'forum' => $forum
		]);

	}

	public function store(Request $request, $forum_id)
	{
		$this->validate($request, [
			'featured_tag' => 'required',
			'title' => 'required|max:50',
			'body' => 'required|max:10000',
		]);

		$theme = new Theme();
		$theme->saveTheme($request, $forum_id);
		$forum = Forum::find($forum_id);

		return redirect()->route('home', ['forum' => $forum])
			->with('status', 'Ваша тема скоро будет опубликована :)');
	}
}
