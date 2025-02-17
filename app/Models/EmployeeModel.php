<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'emp_id',
        'emp_image',
        'emp_name',
        'contact_number',
        'email',
        'employee_name',
        'employee_code',
        'family_contact_number',
        'gender',
        'dob',
        'nationality',
        'address',
        'card_date_of_issue',
        'card_valid_till',
        'company_name',
        'company_employee_code',
        'is_deleted',
    ];

    protected $casts = [
        'company_name' => 'json',
        'company_employee_code' => 'json',
        'dob' => 'date',
        'card_date_of_issue' => 'date',
        'card_valid_till' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }
}
