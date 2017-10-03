<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 05.09.2017
 * Time: 23:00
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return redirect()->route('admin.partners.index');
    }
}
