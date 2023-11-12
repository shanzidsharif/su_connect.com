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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('alt_mobile')->unique();
            $table->string('department');
            $table->string('religious')->nullable();
            $table->string('student_id')->unique();
            $table->string('admission_date')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('blood')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('present_address')->nullable();
            $table->text('image')->nullable();
            $table->string('nid')->unique()->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
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
