<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\EmployeeModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'Indian@123',
        ]);

        EmployeeModel::create([
            // 'emp_image' => 'USLqfHVTxtBbetqVOgV2.jpg',
            'emp_id' => 'ZES0000001',
            'emp_name' => 'Prit Patel',
            'contact_number' => '9510862562',
            'email' => 'prit89039@gmail.com',
            'employee_name' => 'PritPatel',
            'employee_code' => '1067',
            'family_contact_number' => '9925784852',
            'gender' => 'Male',
            'dob' => '2004-08-19',
            'nationality' => 'Indian',
            'address' => 'Ahmedabad',
            'card_date_of_issue' => '2024-12-28',
            'card_valid_till' => '2024-12-31',
            'is_deleted' => false,
        ]);
    }
}
