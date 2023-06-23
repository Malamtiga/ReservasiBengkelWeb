<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class DashboardadminController extends BaseController
{
    public function index()
    {
        return view('tmplt/admin/dashboard');
    }
}
