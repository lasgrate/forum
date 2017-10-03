<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Theme;
use App\Http\Requests\StoreTheme;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('user')->id();

        $themes = User::find($user_id)
            ->themes()
            ->select(DB::raw('count(case when messages.user_view = false then 1 else null end) as viewed_messages'))
            ->leftJoin('messages', 'themes.id', '=', 'messages.theme_id')
            ->groupBy('themes.id')
            ->paginate(10);

        return view('partner.themes.index',[
            'themes' => $themes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth('user')->id();

        $theme = new Theme();

        $forums = User::find($user_id)
            ->forums()
            ->select('id', 'name')
            ->orderBy('created_at', 'asc')
            ->get();

        // Array for select
        $forums_list = [];

        foreach ($forums as $forum) {
            $forums_list = array_add($forums_list, $forum->id, $forum->name);
        }

        $faker = Faker::create();

        return view('partner.themes.form', [
            'theme' => $theme,
            'forums_list' => $forums_list,
            'tags' => collect(),
	        'faker' => $faker,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTheme  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTheme $request)
    {
        $theme = Theme::create($request->all());

        $theme->tags()->attach($request->tags);

        return redirect()->route('partner.themes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user_id = auth('user')->id();

        $theme = Theme::findOrFail($id);

        $forums = User::find($user_id)
            ->forums()
            ->select('id', 'name')
            ->orderBy('created_at', 'asc')
            ->get();

        // Array for select
        $forums_list = [];

        foreach ($forums as $forum) {
            $forums_list = array_add($forums_list, $forum->id, $forum->name);
        }

        $tags = Theme::find($id)->tags()->get();

	    $faker = Faker::create();

	    return view('partner.themes.form', [
            'theme' => $theme,
            'forums_list' => $forums_list,
            'tags' => $tags,
            'faker' => $faker,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTheme  $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreTheme $request, $id)
    {
        $theme = Theme::findOrFail($id);

        $theme->update($request->all());

        $theme->tags()->detach();
        $theme->tags()->attach($request->tags);

        return redirect()->route('partner.themes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);

        $theme->delete();

        return redirect()->route('partner.themes.index');
    }
}
