<?php

namespace App\Services\Student;

use App\Models\StudentAssessment;

class StudentAssessmentService
{
    public function createAssessment(array $data)
    {
        $competencies = $data['competencies'];
        unset($data['competencies']);

        foreach ($competencies as $competencyId => $assessmentRubricId) {
            StudentAssessment::create([
                'user_id' => $data['user_id'],
                'subject_id' => $data['subject_id'] ?? null,
                'competency_id' => $competencyId,
                'assessment_rubric_id' => $assessmentRubricId,
                'academic_year_id' => $data['academic_year_id'],
                'semester_id' => $data['semester_id'],
                'teacher_id' => auth()->id(),
                'assessment_date' => $data['assessment_date'],
                'remarks' => $data['remarks'] ?? null,
            ]);
        }
    }
}
