<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id', 255)->nullable();
            $table->string('emp_image', 255)->nullable();
            $table->string('emp_name', 255)->nullable();
            $table->string('contact_number', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('employee_name', 200)->nullable();
            $table->string('employee_code', 50)->nullable();
            $table->string('family_contact_number', 255)->nullable();
            $table->json('company_name')->nullable();
            $table->json('company_employee_code')->nullable();
            $table->string('gender', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality', 255)->nullable();
            $table->text('address')->nullable();
            $table->date('card_date_of_issue')->nullable();
            $table->date('card_valid_till')->nullable();
            $table->string('qr_code_path', 255)->nullable();
            $table->boolean('is_deleted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_profiles');
    }
};
