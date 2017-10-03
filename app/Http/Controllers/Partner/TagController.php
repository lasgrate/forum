<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use \App\Models\User;
use \App\Models\Forum;
use \App\Models\Tag;
use \App\Http\Requests\StoreTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('user')->id();

        $tags = User::find($user_id)
            ->tags()
            ->paginate(10);

        return view('partner.tags.index', [
            'tags' => $tags,
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

        $tag = new Tag();

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

        return view('partner.tags.form', [
            'tag' => $tag,
            'forums_list' => $forums_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTag $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTag $request)
    {
        Tag::create($request->all());

        return redirect()->route('partner.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        $user_id = auth('user')->id();

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

        return view('partner.tags.form', [
            'tag' => $tag,
            'forums_list' => $forums_list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreTag $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTag $request, $id)
    {
        Tag::findOrFail($id)->update($request->all());

        return redirect()->route('partner.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect()->route('partner.tags.index');
    }

    public function autocomplete(Request $request)
    {
        $tags = Forum::findOrFail($request->input('forum_id'))
            ->tags()
            ->where('tags.name', 'like', '%' . $request->input('name') . '%')
	        ->limit(5)
            ->get()
            ->toArray();

        return response()->json($tags);
    }
}
