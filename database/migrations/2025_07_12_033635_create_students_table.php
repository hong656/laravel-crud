<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('first_name'); // Student's first name
            $table->string('last_name');  // Student's last name
            $table->string('email')->unique(); // Student's email, must be unique
            $table->date('date_of_birth')->nullable(); // Student's date of birth, nullable
            $table->string('major')->nullable(); // Student's major, nullable
            $table->string('student_id_number')->unique()->nullable(); // Unique student ID, nullable
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};