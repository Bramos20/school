<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Student\ReportCardService;
use Illuminate\Http\Request;

class ReportCardController extends Controller
{
    public function show(Request $request, User $student, ReportCardService $reportCardService)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        $reportCardData = $reportCardService->generateReportCard($student, $request->academic_year_id, $request->semester_id);

        return view('pages.student.report-card', compact('student', 'reportCardData'));
    }
}
