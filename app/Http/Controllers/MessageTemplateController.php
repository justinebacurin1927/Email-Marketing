<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function index()
    {
        $templates = MessageTemplate::all();
        return view('audience/message-temp', compact('templates'));
    }

    public function create()
    {
        return view('audience.template-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        MessageTemplate::create($request->only('name', 'subject', 'body'));

        return redirect()->route('templates.index');
    }

    public function edit($id)
{
    $template = MessageTemplate::findOrFail($id);
    return view('audience/template-form', compact('template'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'subject' => 'required',
        'body' => 'required',
    ]);

    $template = MessageTemplate::findOrFail($id);
    $template->update($request->only('name', 'subject', 'body'));

    return redirect()->route('templates.index');
}

public function destroy($id)
{
    $template = MessageTemplate::findOrFail($id);
    $template->delete();

    return redirect()->route('templates.index');
}

}
