<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('student_id')->constrained('users');
            $table->timestamps();

            $table->unique(['student_id','course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_student');
    }
};
