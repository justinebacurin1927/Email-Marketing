<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ContactController extends Controller
{
   public function index()
{
    // Eager load tags for contacts
    $contacts = Contact::with('tags')->orderBy('created_at', 'desc')->paginate(10);

    // Fetch all tags for the dropdown
    $tags = Tag::all();

    return view('audience.audience', compact('contacts', 'tags'));

    $totalContacts = Contact::count();
    $totalSubscribers = Contact::where('subscribed', true)->count();

    return view('audience.dashboards', compact('totalContacts', 'totalSubscribers'));

}

    public function create()
    {
        return view('audience.add-contact');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:contacts,email',
        'first_name' => 'nullable|string',
        'last_name' => 'nullable|string',
        'company' => 'nullable|string',
        'phone' => 'nullable|string',
        'birthday' => 'nullable|date',
        'street' => 'nullable|string',
        'address2' => 'nullable|string',
        'city' => 'nullable|string',
        'region' => 'nullable|string',
        'postal' => 'nullable|string',
        'country' => 'nullable|string',
        'tags' => 'nullable|string'
    ]);

    $contact = Contact::create($validated);

    if (!empty($request->tags)) {
        $tags = array_map('trim', explode(',', $request->tags));

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $contact->tags()->attach($tag->id);
        }
    }

    return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
}


    public function deleteSelected(Request $request)
    {
        $ids = $request->input('selected_contacts');
        if ($ids) Contact::whereIn('id', $ids)->delete();

        return back()->with('success', 'Selected contacts deleted.');
    }

    public function showImportForm()
    {
        return view('audience.import-contacts');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls|max:10240',
            'tags' => 'nullable|string',
            'import_type' => 'required|in:update,skip',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, ['xlsx', 'xls'])) {
            return $this->importExcel($file, $request);
        } else {
            return $this->importCSV($file, $request);
        }
    }

    private function importCSV($file, Request $request)
    {
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');
        $header = fgetcsv($handle);

        if (!$header) {
            return back()->with('error', 'The CSV file is empty or invalid.');
        }

        $header = array_map(fn($h) => strtolower(trim($h)), $header);
        $tagIds = $this->prepareTags($request->input('tags'));

        $imported = 0;
        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($header, $data);
            if (!$row || empty($row['email'])) continue;

            $contact = Contact::where('email', $row['email'])->first();

            if ($contact && $request->import_type === 'update') {
                $contact->update($this->contactData($row, $contact));
            } elseif (!$contact) {
                $contact = Contact::create($this->contactData($row));
            }

        if (!empty($tagIds) && isset($contact)) {
            $contact->tags()->syncWithoutDetaching($tagIds);

            \Log::info('Tags attached for contact (CSV Import)', [
                'contact_id' => $contact->id,
                'tag_ids' => $tagIds,
            ]);
        }


            $imported++;
        }

        fclose($handle);

        return redirect()->route('contacts.index')
            ->with('success', "$imported contacts imported successfully!");
    }

    private function importExcel($file, Request $request)
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        if (count($rows) < 2) {
            return back()->with('error', 'The Excel file is empty or invalid.');
        }

        $header = array_map(fn($h) => strtolower(trim($h)), $rows[0]);
        $dataRows = array_slice($rows, 1);
        $tagIds = $this->prepareTags($request->input('tags'));
        $imported = 0;

        foreach ($dataRows as $row) {
            $rowData = array_combine($header, $row);
            if (!$rowData || empty($rowData['email'])) continue;

            $contact = Contact::where('email', $rowData['email'])->first();

            if ($contact && $request->import_type === 'update') {
                $contact->update($this->contactData($rowData, $contact));
            } elseif (!$contact) {
                $contact = Contact::create($this->contactData($rowData));
            }

            if (!empty($tagIds) && isset($contact)) {
                $contact->tags()->syncWithoutDetaching($tagIds);

                \Log::info('Tags attached for contact (Excel Import)', [
                    'contact_id' => $contact->id,
                    'tag_ids' => $tagIds,
                ]);
            }

            $imported++;
        }

        return redirect()->route('contacts.index')
            ->with('success', "$imported contacts imported successfully!");
    }

    private function prepareTags($tagsInput)
    {
        if (!$tagsInput) return [];

        $tagIds = [];
        $tagNames = array_map('trim', explode(',', $tagsInput));

        foreach ($tagNames as $name) {
            if ($name === '') continue;
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    private function contactData($row, $existing = null)
    {
        return [
            'email'      => $row['email'] ?? ($existing->email ?? null),
            'first_name' => $row['first_name'] ?? ($existing->first_name ?? null),
            'last_name'  => $row['last_name'] ?? ($existing->last_name ?? null),
            'company'    => $row['company'] ?? ($existing->company ?? null),
            'phone'      => $row['phone'] ?? ($existing->phone ?? null),
            'birthday'   => $row['birthday'] ?? ($existing->birthday ?? null),
            'street'     => $row['street'] ?? ($existing->street ?? null),
            'address2'   => $row['address2'] ?? ($existing->address2 ?? null),
            'city'       => $row['city'] ?? ($existing->city ?? null),
            'region'     => $row['region'] ?? ($existing->region ?? null),
            'postal'     => $row['postal'] ?? ($existing->postal ?? null),
            'country'    => $row['country'] ?? ($existing->country ?? null),
        ];
    }

public function update(Request $request, $id)
{
    $contact = Contact::findOrFail($id);

    $contact->email = $request->email;
    $contact->first_name = $request->first_name;
    $contact->last_name = $request->last_name;
    $contact->phone = $request->phone;
    $contact->company = $request->company;
    $contact->birthday = $request->birthday;
    $contact->street = $request->address;
    $contact->save();

    // Handle tags
    if ($request->filled('tags')) {
        $tagNames = collect(explode(',', $request->tags))
            ->map(fn($tag) => trim($tag))
            ->filter();

        $tagIds = [];
        foreach ($tagNames as $name) {
            $tag = \App\Models\Tag::firstOrCreate(['name' => $name]);
            $tagIds[] = $tag->id;
        }

        $contact->tags()->sync($tagIds);
    } else {
        $contact->tags()->detach();
    }

    return response()->json(['success' => true]);
}

public function export()
{
    $contacts = Contact::with('tags')->get();

    $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
    $handle = fopen($filename, 'w+');

    // Header row
    fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Company', 'Birthday', 'Address', 'Tags', 'Created At']);

    foreach ($contacts as $contact) {
        $tags = $contact->tags->pluck('name')->implode(', ');
        fputcsv($handle, [
            $contact->id,
            $contact->first_name,
            $contact->last_name,
            $contact->email,
            $contact->phone,
            $contact->company,
            $contact->birthday,
            $contact->street,
            $tags,
            $contact->created_at
        ]);
    }

    fclose($handle);

    return response()->download($filename)->deleteFileAfterSend(true);
}


}
