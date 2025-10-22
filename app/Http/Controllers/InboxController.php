<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return view('audience.inbox'); // Make sure this view exists
    }

    public function settings()
    {
        return view('audience.inbox-settings');
    }

}
