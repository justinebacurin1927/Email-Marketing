<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip rows missing email
        if (empty($row['email'])) {
            return null;
        }

        // Check for existing contact
        $existing = Contact::where('email', $row['email'])->first();

        if ($existing) {
            $existing->update([
                'first_name' => $row['first_name'] ?? null,
                'last_name' => $row['last_name'] ?? null,
                'company' => $row['company'] ?? null,
                'phone' => $row['phone'] ?? null,
                'birthday' => $row['birthday'] ?? null,
                'street' => $row['street'] ?? null,
                'address2' => $row['address2'] ?? null,
                'city' => $row['city'] ?? null,
                'region' => $row['region'] ?? null,
                'postal' => $row['postal'] ?? null,
                'country' => $row['country'] ?? null,
            ]);
            return null; // Don’t duplicate
        }

        // Otherwise create new
        return new Contact([
            'email' => $row['email'],
            'first_name' => $row['first_name'] ?? null,
            'last_name' => $row['last_name'] ?? null,
            'company' => $row['company'] ?? null,
            'phone' => $row['phone'] ?? null,
            'birthday' => $row['birthday'] ?? null,
            'street' => $row['street'] ?? null,
            'address2' => $row['address2'] ?? null,
            'city' => $row['city'] ?? null,
            'region' => $row['region'] ?? null,
            'postal' => $row['postal'] ?? null,
            'country' => $row['country'] ?? null,
        ]);
    }
}
