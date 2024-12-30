<?php

namespace App\Imports;

use App\Models\EmployeeModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImporter implements ToCollection, ToModel
{
    private $num = 0;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
    }

    public function model(array $row)
    {
        $this->num++;
        if ($this->num > 1) {
            $emp = EmployeeModel::where('emp_id', '=', $row[0])->count();
            if (empty($emp)) {
                $employee = new EmployeeModel();
                $employee->emp_id = $row[0];
                $employee->emp_image = $row[1];
                $employee->emp_name = $row[2];
                $employee->contact_number = $row[3];
                $employee->email = $row[4];
                $employee->employee_name = $row[5];
                $employee->employee_code = $row[6];
                $employee->family_contact_number = $row[7];
                $employee->gender = $row[8];
                $employee->dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('Y-m-d');
                $employee->nationality = $row[10];
                $employee->address = $row[11];
                $employee->card_date_of_issue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d');
                $employee->card_valid_till = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('Y-m-d');
                $employee->company_name = explode(', ', $row[14]);
                $employee->company_employee_code = explode(', ', $row[15]);
                $employee->is_deleted = $row[16];
                $employee->save();
            } else {
                $record = EmployeeModel::where('emp_id', '=', $row[0])->first();
                $record->emp_image = $row[1];
                $record->emp_name = $row[2];
                $record->contact_number = $row[3];
                $record->email = $row[4];
                $record->employee_name = $row[5];
                $record->employee_code = $row[6];
                $record->family_contact_number = $row[7];
                $record->gender = $row[8];
                $record->dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('Y-m-d');
                $record->nationality = $row[10];
                $record->address = $row[11];
                $record->card_date_of_issue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d');
                $record->card_valid_till = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('Y-m-d');
                $record->company_name = explode(',', $row[14]);
                $record->company_employee_code = explode(',', $row[15]);
                $record->is_deleted = $row[16];
                $record->save();
            }
        }
    }
}
