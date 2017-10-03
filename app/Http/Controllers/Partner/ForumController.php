<?php

namespace App\Http\Controllers\Partner;

use App\Models\User;
use App\Models\Decor;
use App\Http\Requests\StoreForum;
use App\Http\Controllers\Controller;
use App\Models\Forum;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('user')->id();

        $forums = User::find($user_id)->forums()
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('partner.forums.index', [
            'forums' => $forums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forum = new Forum();
        $decors = Decor::all();
        $decors_list = [];
        foreach ($decors as $decor) {
            $decors_list = array_add($decors_list, $decor->id, $decor->name);
        }
        return view('partner.forums.form', [
            'forum' => $forum,
            'decors_list' => $decors_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreForum $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreForum $request)
    {
        $user_id = auth('user')->id();

        Forum::create(array_add($request->all(), 'user_id', $user_id));

        return redirect()->route('partner.forums.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum = Forum::findOrFail($id);
        $decors = Decor::all();
        $decors_list = [];
        foreach ($decors as $decor) {
            $decors_list = array_add($decors_list, $decor->id, $decor->name);
        }
        return view('partner.forums.form', [
            'forum' => $forum,
            'decors_list' => $decors_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreForum $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreForum $request, $id)
    {
        $partner = Forum::findOrFail($id);
        $partner->update($request->all());

        return redirect()->route('partner.forums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);

        $forum->delete();

        return redirect()->route('partner.forums.index');
    }
}
