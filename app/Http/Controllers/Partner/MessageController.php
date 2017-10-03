<?php

namespace App\Http\Controllers\Partner;

use App\Models\Client;
use App\Models\Theme;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessage;
use App\Notifications\ThemeHasNewMessages;
use Illuminate\Support\Facades\Notification;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MessageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($theme_id)
	{
		$theme = Theme::findOrFail($theme_id);

		$messages = $theme
			->messages()
			->orderBy('created_at', 'desc')
			->paginate(10);

		$faker = Faker::create();
		$carbon = new Carbon();

		return view('partner.messages.index', [
			'messages' => $messages,
			'theme' => $theme,
			'faker' => $faker,
			'carbon' => $carbon,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreMessage $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreMessage $request, $theme_id)
	{
		$message = Theme::findOrFail($theme_id)->messages()->create([
			'fake_name' => $request->fake_name,
			'text' => $request->text,
			'created_at' => $request->created_at,
			'is_enable' => $request->is_enable,
			'user_view' => true,
			'client_view' => false,
		]);

		$clients = Client::whereIn('id', function ($query) use ($theme_id) {
			$query->from(with(new Theme)->getTable())
				->select('clients.id')
				->leftJoin('messages', 'messages.theme_id', '=', 'themes.id')
				->leftJoin('clients', 'clients.id', '=', 'messages.client_id')
				->where('themes.id', $theme_id);
		})->get();

//        Notification::send($clients, new ThemeHasNewMessages($message));

		return redirect()->route('partner.messages.index', [
			'theme_id' => $theme_id,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id)
	{
		$message = Message::findOrFail($id);

		$message->user_view = true;
		$message->save();

		$isClient = !is_null($message->client);

		return view('partner.messages.form', [
			'message' => $message,
			'isClient' => $isClient,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$message = Message::findOrFail($id);

		$message->update($request->all());

		return redirect()->route('partner.messages.index', [
			'theme_id' => $message->theme->id,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($theme_id, $id)
	{
		$message = Message::findOrFail($id);

		$message->delete();

		return redirect()->route('partner.messages.index', [
			'theme_id' => $theme_id,
		]);
	}
}
