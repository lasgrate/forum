<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Support\Facades\DB;
use \App\Models\User;
use \App\Models\Client;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $user_id = auth('user')->id();

        $clients = User::findOrFail($user_id)
            ->clients()
            ->paginate(10);

        return view('partner.clients.index', [
            'clients' => $clients,
        ]);
    }

    public function login($client_id)
    {
        auth()->loginUsingId($client_id);

        $forum_id = Client::findOrFail($client_id)->forum->id;

        return redirect()->route('home', [
            'forum_id' => $forum_id,
        ]);
    }
}
