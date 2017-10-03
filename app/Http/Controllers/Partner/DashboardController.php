<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 11.09.2017
 * Time: 21:49
 */

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('partner.forums.index');
    }
}
