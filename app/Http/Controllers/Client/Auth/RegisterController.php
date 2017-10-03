<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\Client;
use App\Models\Forum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = 'forum/';

    protected $request;

    public function __construct(Request $request)
    {
        $this->redirectTo = $this->redirectTo . $request->forum_id;
        $this->request = $request;
        $this->middleware('guest:clients');
    }

    protected function index($forum_id)
    {
        $forum = Forum::find($forum_id);

        return view('client.auth.register', ['forum' => $forum]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Client::create([
            'forum_id' => $this->request->forum_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }
}
