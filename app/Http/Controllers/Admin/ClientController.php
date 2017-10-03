<?php

namespace App\Http\Controllers\Admin;

use \App\Models\Client;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10);

        return view('admin.clients.index', [
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
