<?php
// app/Http/Controllers/TagController.php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->get();
        return view('audience.audience-tags', compact('tags')); // Make sure this matches your blade file name
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags'
        ]);

        $tag = Tag::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'tag' => $tag,
            'message' => 'Tag created successfully!'
        ]);
    }

    public function update(Request $request, Tag $tag): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'tag' => $tag,
            'message' => 'Tag renamed successfully!'
        ]);
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully!'
        ]);
    }

    public function bulkDestroy(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tags,id'
        ]);

        Tag::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tags deleted successfully!'
        ]);
    }
}