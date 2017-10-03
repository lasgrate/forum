<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\Forum;
use App\Models\Client;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'forum/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->redirectTo = $this->redirectTo . $request->forum_id;

        $this->middleware('guest:clients');
    }

    public function index(Request $request, $forum_id, $token = null)
    {
        $forum = Forum::find($forum_id);

        return view('client.auth.passwords.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'forum' => $forum
            ]
        );
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $client_resets = DB::table('password_resets')
            ->whereRaw('email = ? and token = ? and is_private = ?', [$request->email, $request->token, false])
            ->first();

        if (empty($client_resets)) {
            $error = 'Не верный E-mail или токен';
            throw ValidationException::withMessages([
                'email' => [$error],
            ]);
        } else {
            Client::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

            DB::table('password_resets')
                ->where('email', $request->email)
                ->update(['is_private' => true]);

            $forum = Forum::find($request->forum_id);

            return redirect()->route('home', ['forum' => $forum])->with('status', 'Ваш пароль обновлен!');
        }
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }
}
