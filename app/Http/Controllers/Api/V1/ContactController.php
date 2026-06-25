<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ContactResource;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('tags')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('name', $request->tag));
        }

        $perPage = min($request->integer('per_page', 15), 100);

        return ContactResource::collection($query->paginate($perPage));
    }

    public function show(Contact $contact)
    {
        $contact->load('tags');

        return new ContactResource($contact);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'subscribed' => 'boolean',
            'permission' => 'boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $validated['subscribed'] = $request->boolean('subscribed');
        $validated['permission'] = $request->boolean('permission');

        $contact = Contact::create($validated);

        if (!empty($validated['tag_ids'])) {
            $contact->tags()->sync($validated['tag_ids']);
        }

        $contact->load('tags');

        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'email' => 'sometimes|email|unique:contacts,email,' . $contact->id,
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
            'subscribed' => 'boolean',
            'permission' => 'boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        if ($request->has('subscribed')) {
            $validated['subscribed'] = $request->boolean('subscribed');
        }
        if ($request->has('permission')) {
            $validated['permission'] = $request->boolean('permission');
        }

        $contact->update($validated);

        if ($request->has('tag_ids')) {
            $contact->tags()->sync($validated['tag_ids'] ?? []);
        }

        $contact->load('tags');

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully.']);
    }
}
