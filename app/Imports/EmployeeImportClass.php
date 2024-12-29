<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\EmployeeModel;

class EmployeeImportClass implements ToModel
{
    public function model(array $row)
    {
        // Define how to create a model from the Excel row data
        return new EmployeeModel([
            'emp_id' => $row[0],
            'emp_image' => $row[1],
            'emp_name' => $row[2],
            'contact_number' => $row[3],
            'email' => $row[4],
            'employee_name' => $row[5],
            'employee_code' => $row[6],
            'family_contact_number' => $row[7],
            'gender' => $row[8],
            'dob' => $row[9],
            'nationality' => $row[10],
            'address' => $row[11],
            'card_date_of_issue' => $row[12],
            'card_valid_till' => $row[13],
            'company_name' => $row[14],
            'company_employee_code' => $row[15],
        ]);
    }
}
