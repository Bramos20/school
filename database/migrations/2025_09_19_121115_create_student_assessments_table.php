<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('student_assessments', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('competency_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('assessment_rubric_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->date('assessment_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_assessments');
    }
};
