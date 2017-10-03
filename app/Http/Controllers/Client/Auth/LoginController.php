<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\Forum;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = 'forum/';

    public function __construct(Request $request)
    {
        $this->redirectTo = $this->redirectTo . $request->forum_id;
        $this->middleware('guest:clients')->except('logout');
    }

    public function index($forum_id)
    {
        $forum = Forum::find($forum_id);

        return view('client.auth.login', ['forum' => $forum]);
    }

    public function authenticate(Request $request)
    {
        $remember = $request->has('remember');

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'forum_id' => $request->forum_id
        ], $remember)
        ) {
            return redirect()->intended('forum/' . $request->forum_id);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Данные аутентифекации не верны'
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($this->redirectTo);
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }

}
