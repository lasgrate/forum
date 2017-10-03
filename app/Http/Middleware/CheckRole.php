<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode(';', $roles);

        if ($this->auth->check()) {

            $fail = true;

            foreach ($roles as $role) {
                if ($role == $this->auth->user()->role) {
                    $fail = false;
                }
            }

            if ($fail) {
                return abort(403, 'Access Denied');
            }

        } else {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin');
            }
        }

        return $next($request);
    }
}
