<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;

class ApiContactImportController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'tags' => 'nullable|string',
            'import_type' => 'required|in:update,skip',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Excel::import(new ContactsImport($request->tags, $request->import_type), $request->file('file'));
            return response()->json([
                'status' => 'success',
                'message' => 'Contacts imported successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Import failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
