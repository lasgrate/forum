<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 05.09.2017
 * Time: 19:16
 */

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Current guard
     *
     * @var \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $auth;

    public function __construct()
    {
        $this->auth = auth('user');
    }

    /**
     * Introduce login form for admin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($this->auth->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if ($this->auth->user()->role == 'partner') {
                return redirect()->intended('partner/dashboard');
            } else {
                return redirect()->intended('admin/dashboard');
            }
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout() {

        auth('user')->logout();

        return redirect()->route('admin');
    }
}