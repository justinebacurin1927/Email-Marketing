<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('add-contact');
    }

    public function index()
    {
        $contacts = Contact::latest()->get();
        // show the "audience" view instead of "contacts"
        return view('audience', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:contacts,email',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'birthday' => 'nullable|date',
            'street' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Contact added successfully.');
    }

    public function deleteSelected(Request $request)
{
    $ids = $request->input('selected_contacts');
    if ($ids) Contact::whereIn('id', $ids)->delete();
    return back()->with('success', 'Selected contacts deleted.');
}

}
