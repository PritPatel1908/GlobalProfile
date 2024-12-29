<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\EmployeeImportClass;

use Illuminate\Http\Request;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new EmployeeImportClass, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
