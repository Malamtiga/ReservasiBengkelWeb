<?php

namespace App\Controllers\pengguna;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('tmplt/pengguna/dashboardcok');
    }
}
