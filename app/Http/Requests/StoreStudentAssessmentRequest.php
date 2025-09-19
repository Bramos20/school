<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'assessment_date' => 'required|date',
            'remarks' => 'nullable|string',
            'competencies' => 'required|array',
            'competencies.*' => 'required|exists:assessment_rubrics,id',
        ];
    }
}
