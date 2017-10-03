<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\Forum;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($forum_id, $tag_id)
    {
        $theme = new Theme();
        $forum = Forum::find($forum_id);
        $themes = $theme->getForumThemesByTag($forum_id, $tag_id);
        $colourSet = explode(',', $forum->decor()->first()->colors);

        return view('client.home.index', [
        	'forum' => $forum,
		        'tag_id' => $tag_id,
		        'themes' => $themes,
		        'colourSet' => $colourSet,
	        ]
        );
    }

	public function autocomplete(Request $request)
	{
		$tags = Forum::findOrFail($request->forum_id)
			->tags()
			->where('tags.name', 'like', '%' . $request->input('name') . '%')
			->limit(5)
			->get()
			->toArray();

		return response()->json($tags);
	}
}
