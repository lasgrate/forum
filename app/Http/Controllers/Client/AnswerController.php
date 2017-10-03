<?php

namespace App\Http\Controllers\Client;

use App\Models\Theme;
use App\Models\Forum;
use App\Models\Tag;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth.redirect');
	}

	public function index($forum_id)
	{
		$theme = new Theme();
		$themes = $theme->getAllClientTheme($forum_id, auth()->id());
		$tags = Tag::getForumTagsByThemes($themes);
		$forum = Forum::find($forum_id);
		$colourSet = explode(',', $forum->decor()->first()->colors);

		return view('client.answer.show', [
			'forum' => $forum,
			'tags' => $tags,
			'themes' => $themes,
			'colourSet' => $colourSet,
		]);
	}

	public function show($forum_id, $tag_id)
	{
		$theme = new Theme();
		$themes = $theme->getForumAnswerThemesByTag($forum_id, $tag_id, auth()->id());
		$tags = $theme->getAllAnswerTagByForumId($forum_id, auth()->id());
		$forum = Forum::find($forum_id);
		$colourSet = explode(',', $forum->decor()->first()->colors);

		return view('client.answer.show', [
			'forum' => $forum,
			'tags' => $tags,
			'themes' => $themes,
			'colourSet' => $colourSet,
		]);
	}
}
