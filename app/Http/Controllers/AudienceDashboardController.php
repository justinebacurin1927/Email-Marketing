<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AudienceDashboardController extends Controller
{
    public function index()
    {
        $audienceName = 'Jaycee';
        $totalContacts = Contact::count();
        $totalSubscribers = Contact::where('subscribed', true)->count();

        return view('audience.dashboards', compact('audienceName', 'totalContacts', 'totalSubscribers'));
    }
}
