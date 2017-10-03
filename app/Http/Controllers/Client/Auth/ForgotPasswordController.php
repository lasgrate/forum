<?php

namespace App\Http\Controllers\Client\Auth;

use Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\Forum;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:clients');
    }

    public function index($forum_id)
    {
        $forum = Forum::find($forum_id);

        return view('client.auth.passwords.email', ['forum' => $forum]);
    }

    public function sendPasswordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
        ]);

        $client = Client::where([
            'email' => $request->email,
            'forum_id' => $request->forum_id
        ])->first();

        if (empty($client) || !$request->_token) {
            $error = 'Пользователь с данным E-mail отсутствует';
            throw ValidationException::withMessages([
                'email' => [$error],
            ]);
        } else {
            $url = url('forum/' . $request->forum_id . '/' . 'password/reset/' . $request->_token);
            Mail::send('mail.reset.email', [$request, $client, 'url' => $url], function ($m) use ($request, $client) {
                $m->from('hello@app.com', 'Your Application');
                $m->to($client->email, $client->name)->subject('Your Password Reset Link!');
            });

            DB::table('password_resets')->insert([
                [
                    'email' => $client->email,
                    'token' => $request->_token,
                    'is_private' => false,
                    'created_at' => date("Y-m-d H:i:s")
                ]
            ]);

            $forum = Forum::find($request->forum_id);

            return redirect()->route('password.reset', ['forum' => $forum])
                ->with('status', 'Ссылка для сброса пароля отправлена на ваш E-mail');
        }
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }
}
