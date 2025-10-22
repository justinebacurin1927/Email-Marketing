<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AudienceController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('audience.audience', compact('contacts'));
    }
}

