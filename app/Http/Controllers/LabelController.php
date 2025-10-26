<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all(); // fetch all labels
        return view('audience.add-labels', compact('labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Label::create(['name' => $request->name]);

        return redirect()->route('labels.index')->with('success', 'Label added successfully');
    }

    public function destroy($id)
    {
        $label = Label::findOrFail($id);
        $label->delete();

        return redirect()->route('labels.index')->with('success', 'Label deleted successfully');
    }
}
