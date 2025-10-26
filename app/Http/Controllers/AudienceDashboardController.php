<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudienceDashboardController extends Controller
{
    public function dashboards()
    {
        // Later you can pass dynamic stats here
        return view('audience.dashboards');
    }
}
