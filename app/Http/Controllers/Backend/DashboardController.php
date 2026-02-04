<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller

{
    protected $masterView = 'backend.admin.pages.dashboard';

    public function index()
    {
        return view($this->masterView);
    }
}
