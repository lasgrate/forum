<?php

namespace App\Http\Middleware;

use App\Models\Forum;
use App\Models\Client;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckForum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Forum::findOrFail($request->forum_id);
        if(Auth::guard('clients')->check()) {
           $client = Client::find(Auth::guard('clients')->id());
           if($client->forum_id != $request->forum_id) {
               return redirect()->route('home', ['forum_id' => $client->forum_id]);
           }

        }
        return $next($request);
    }
}
