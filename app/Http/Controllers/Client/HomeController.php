<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\Forum;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.redirect')->except('index');
    }

    public function index($forum_id)
    {
        $theme = new Theme();
        $themes = $theme->getAllThemeByForumId($forum_id);
        $forum = Forum::find($forum_id);
        $colourSet = explode(',', $forum->decor()->first()->colors);

        return view('client.home.index', compact('forum', 'countAnswer', 'themes', 'colourSet'), [
	        'theme' => $theme,
	        'themes' => $themes,
	        'forum' => $forum,
	        'colourSet' => $colourSet,
        ]);
    }
}
