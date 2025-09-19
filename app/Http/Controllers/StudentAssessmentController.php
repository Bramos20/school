<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentAssessmentRequest;
use App\Models\AcademicYear;
use App\Models\Competency;
use App\Models\AssessmentRubric;
use App\Models\Semester;
use App\Services\MyClass\MyClassService;
use App\Services\Student\StudentService;
use App\Services\Subject\SubjectService;
use Illuminate\Http\Request;

class StudentAssessmentController extends Controller
{
    public function create()
    {
        return view('pages.student-assessment.create');
    }

    public function store(StoreStudentAssessmentRequest $request, \App\Services\Student\StudentAssessmentService $studentAssessmentService)
    {
        $studentAssessmentService->createAssessment($request->validated());

        return back()->with('success', 'Assessment created successfully');
    }
}
