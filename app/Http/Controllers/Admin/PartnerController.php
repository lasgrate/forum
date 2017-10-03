<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StorePartner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $role = 'partner';

    public function index()
    {
        $partners = User::where('role', $this->role)->paginate(10);

        return view('admin.partners.index', [
            'partners' => $partners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = new User();

        return view('admin.partners.form', [
            'partner' => $partner,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartner $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartner $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $this->role,
        ]);

        return redirect()->route('admin.partners.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = User::findOrFail($id);

        return view('admin.partners.form', [
            'partner' => $partner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePartner $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePartner $request, $id)
    {
        $partner = User::findOrFail($id);

        $partner->update([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->email),
        ]);

        return redirect()->route('admin.partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->delete();

        return redirect()->route('admin.partners.index');
    }

    public function login($id)
    {

        session([
            'user' => [
                'id' => auth('user')->id(),
                'role' => auth('user')->user()->role,
            ]
        ]);

        auth('user')->logout();
        auth('user')->loginUsingId($id);

        return redirect()->route('partner.dashboard');
    }
}
