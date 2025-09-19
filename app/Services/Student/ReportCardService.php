<?php

namespace App\Services\Student;

use App\Models\User;

class ReportCardService
{
    public function generateReportCard(User $student, int $academicYearId, int $semesterId)
    {
        $assessments = $student->assessments()
            ->where('academic_year_id', $academicYearId)
            ->where('semester_id', $semesterId)
            ->with(['subject', 'competency', 'assessmentRubric'])
            ->get();

        $portfolioItems = $student->portfolioItems()
            ->latest()
            ->take(5)
            ->get();

        return [
            'assessments' => $assessments,
            'portfolioItems' => $portfolioItems,
        ];
    }
}
