<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::orderBy('name', 'asc')->paginate(10);

        return view('admin.settings.index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = new Setting();

        return view('admin.settings.form', [
            'setting' => $setting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSetting $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSetting $request)
    {
        Setting::create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.settings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view('admin.settings.form', [
            'setting' => $setting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSetting $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSetting $request, $id)
    {
	    $user = User::findOrFail($id);

        $user->updade($request->all());

        return redirect()->route('admin.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        $setting->delete();

        return redirect()->route('admin.settings.index');
    }
}
