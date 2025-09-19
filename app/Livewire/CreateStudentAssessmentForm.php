<?php

namespace App\Livewire;

use App\Models\AcademicYear;
use App\Models\Competency;
use App\Models\AssessmentRubric;
use App\Models\MyClass;
use App\Models\Section;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class CreateStudentAssessmentForm extends Component
{
    public $students;
    public $subjects;
    public $competencies;
    public $rubrics;
    public $academicYears;
    public $semesters;
    public $classes;
    public $sections;
    public $class;
    public $section;


    public function mount()
    {
        $this->competencies = Competency::all();
        $this->rubrics = AssessmentRubric::all();
        $this->academicYears = AcademicYear::all();
        $this->semesters = Semester::all();
        $this->classes = MyClass::all();
        $this->students = collect();
        $this->sections = collect();
    }

    public function updatedClass($value)
    {
        $this->sections = Section::where('my_class_id', $value)->get();
        $this->students = User::whereIn('id', function ($query) use ($value) {
            $query->select('user_id')->from('student_records')->where('my_class_id', $value);
        })->get();
    }

    public function updatedSection($value)
    {
        $this->students = User::whereIn('id', function ($query) use ($value) {
            $query->select('user_id')->from('student_records')->where('section_id', $value);
        })->get();
    }



    public function render()
    {
        return view('livewire.create-student-assessment-form');
    }

    public function store()
    {
        $this->validate([
            'class' => 'required|exists:my_classes,id',
            'section' => 'required|exists:sections,id',
            'students' => 'required|array',
            'academicYears' => 'required|exists:academic_years,id',
            'semesters' => 'required|exists:semesters,id',
            'assessment_date' => 'required|date',
            'competencies' => 'required|array',
            'competencies.*' => 'required|exists:assessment_rubrics,id',
        ]);

        foreach ($this->students as $studentId) {
            $student = User::find($studentId);
            if ($student) {
                app(\App\Services\Student\StudentAssessmentService::class)->createAssessment([
                    'user_id' => $student->id,
                    'academic_year_id' => $this->academicYears,
                    'semester_id' => $this->semesters,
                    'assessment_date' => $this->assessment_date,
                    'competencies' => $this->competencies,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Assessments created successfully');
    }
}
