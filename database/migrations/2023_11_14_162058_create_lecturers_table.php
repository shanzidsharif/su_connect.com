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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('mobile')->unique();
            $table->string('position')->nullable();
            $table->string('experience')->nullable();
            $table->string('department')->nullable();
            $table->string('qualification')->nullable();
            $table->string('gender')->nullable();
            $table->string('lecturer_id')->unique()->nullable();
            $table->string('joining_date')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('maritial_status')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('present_address')->nullable();
            $table->text('bio')->nullable();
            $table->text('image')->nullable();
            $table->string('nid')->unique()->nullable();
            $table->string('semester_assign_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
