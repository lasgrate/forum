<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function logout()
    {
        auth('user')->logout();
        auth('user')->loginUsingId(session('user.id'));

        session()->forget('user');

        return redirect()->route('admin.dashboard');
    }
}

