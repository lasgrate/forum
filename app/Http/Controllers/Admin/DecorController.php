<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreDecor;
use Illuminate\Support\Facades\File;
use App\Models\Decor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DecorController extends Controller
{
	public function index()
	{
		$decors = Decor::paginate(10);

		return view('admin.decors.index', [
			'decors' => $decors,
		]);
	}

	public function create()
	{
		$decor = new Decor();

		return view('admin.decors.form', [
			'decor' => $decor,
		]);
	}

	public function store(StoreDecor $request)
	{
		$decor = Decor::create($request->all());

		$request->file('style')->storeAs('css/forum', 'decor_' . $decor->id . '.css', 'uploads');

		return redirect()->route('admin.decors.index');
	}

	public function edit($id)
	{
		$decor = Decor::findOrFail($id);

		return view('admin.decors.form', [
			'decor' => $decor,
		]);
	}

	public function update(StoreDecor $request, $id)
	{
		$decor = Decor::findOrFail($id);

		if ($request->hasFile('style')) {
			File::delete('css/forum/decor_' . $decor->id . '.css');
			$request->file('style')->storeAs('css/forum', 'decor_' . $id . '.css', 'uploads');
		}

		$decor->update([
			'name' => $request->name,
			'colors' => $request->colors,
		]);

		return redirect()->route('admin.decors.index');
	}

	public function destroy($id)
	{
		$decor = Decor::findOrFail($id);

		if (count($decor->forums()->get()) > 0) {
			Session::flash('error', 'Вы не можете удалить тему которая используеться в форумах');
			return redirect()->back();
		}

		$decor->delete();
		File::delete('css/forum/decor_' . $id . '.css');

		return redirect()->route('admin.decors.index');
	}

	public function getDownload($id)
	{
		$decor = Decor::findOrFail($id);
		$file = public_path() . '/css/forum/decor_' . $id . '.css';

		return response()->download($file, $decor->name . '.css');
	}

}
