<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ApiContactController extends Controller
{
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:contacts,email',
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'birthday' => 'nullable|date',
        'street' => 'nullable|string|max:255',
        'address2' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'region' => 'nullable|string|max:255',
        'postal' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'tags' => 'nullable|string|max:255',
        'permission' => 'boolean',
        'subscribed' => 'boolean'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $contact = Contact::create($validator->validated());

    // Handle tag linking
    if ($request->filled('tags')) {
        $tags = array_map('trim', explode(',', $request->tags));

        $tagIds = [];
        foreach ($tags as $tagName) {
            $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $contact->tags()->sync($tagIds);
    }

    return response()->json([
        'message' => 'Contact added successfully',
        'contact' => $contact->load('tags')
    ], 201);
}

    public function index()
    {
        return Contact::all();
    }
}
