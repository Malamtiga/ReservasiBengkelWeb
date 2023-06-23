<?php

namespace App\Controllers\bengkel;

use App\Controllers\BaseController;

class DashboardbengkelController extends BaseController
{
    public function index()
    {
        return view('tmplt/bengkel/dashboard');
    }
}
