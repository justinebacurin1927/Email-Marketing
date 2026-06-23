<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Tag;

class AudienceDashboardController extends Controller
{
    public function index()
    {
        $audienceName = 'My Audience';
        $totalContacts = Contact::count();
        $totalSubscribers = Contact::where('subscribed', true)->count();

        $tags = Tag::withCount('contacts')->get();

        return view('audience.dashboards', compact('audienceName', 'totalContacts', 'totalSubscribers', 'tags'));
    }
}
