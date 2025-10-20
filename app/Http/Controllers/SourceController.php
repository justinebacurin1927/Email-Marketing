<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;

class SourceController extends Controller
{
    // Show add-source page
    public function index()
    {
        // Fetch sources with their messages
        $sources = Source::with('messages')->get();

        return view('add-source', compact('sources'));
    }

    // Store a new source
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:sources,email'
        ]);

        Source::create(['email' => $request->email]);

        return redirect()->back();
    }

    // Delete a source
    public function destroy($id)
    {
        Source::findOrFail($id)->delete();
        return back();
    }
}
