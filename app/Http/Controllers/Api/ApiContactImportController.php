<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Tag;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ApiContactImportController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'tags' => 'nullable|string',
            'import_type' => 'required|in:merge,overwrite',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        try {
            $file = $request->file('file');
            $importType = $request->import_type;
            $globalTags = collect(explode(',', $request->tags))->map(fn($t) => trim($t))->filter();

            $rows = Excel::toArray([], $file)[0]; // get first sheet
            $header = array_map(fn($h) => Str::slug($h, '_'), array_shift($rows)); // map header

            foreach ($rows as $row) {
                $data = array_combine($header, $row);

                if (empty($data['email'])) continue;

                // Merge or Overwrite
                $contact = Contact::firstOrNew(['email' => $data['email']]);

                if ($importType === 'overwrite') {
                    $contact->fill($data);
                } else {
                    // Merge: fill only missing fields
                    foreach ($data as $key => $value) {
                        if (!empty($value) && empty($contact->$key)) {
                            $contact->$key = $value;
                        }
                    }
                }

                $contact->save();

                // Handle tags from form + CSV 'tags' column
                $tags = collect(explode(',', $data['tags'] ?? ''))->merge($globalTags)->map(fn($t) => trim($t))->filter();
                $tagIds = [];
                foreach ($tags as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }

                if (!empty($tagIds)) {
                    $contact->tags()->syncWithoutDetaching($tagIds);
                }
            }

            return redirect()->route('contacts.index')
                             ->with('success', 'Contacts imported successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
