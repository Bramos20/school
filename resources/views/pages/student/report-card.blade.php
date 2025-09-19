@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> '#', 'text'=> 'Report Card' , 'active'],
]])

@section('title', __('Student Report Card'))

@section('page_heading',  __('Student Report Card'))

@section('content' )
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$student->name}}'s Report Card</h3>
        </div>
        <div class="card-body">
            <form action="{{route('report-cards.show', $student->id)}}" method="GET" class="md:grid grid-cols-3 gap-4">
                <x-select id="academic-year" name="academic_year_id" label="Academic Year *" >
                    @foreach (\App\Models\AcademicYear::all() as $academicYear)
                        <option value="{{$academicYear->id}}">{{$academicYear->name}}</option>
                    @endforeach
                </x-select>
                <x-select id="semester" name="semester_id" label="Semester *" >
                    @foreach (\App\Models\Semester::all() as $semester)
                        <option value="{{$semester->id}}">{{$semester->name}}</option>
                    @endforeach
                </x-select>
                <x-button label="Generate Report Card" theme="primary" type="submit" class="w-full "/>
            </form>

            @isset($reportCardData)
                <div class="mt-4">
                    <h4 class="text-bold">Assessments</h4>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Subject</th>
                                <th class="px-4 py-2">Competency</th>
                                <th class="px-4 py-2">Rubric</th>
                                <th class="px-4 py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportCardData['assessments'] as $assessment)
                                <tr>
                                    <td class="border px-4 py-2">{{$assessment->subject->name ?? 'N/A'}}</td>
                                    <td class="border px-4 py-2">{{$assessment->competency->name}}</td>
                                    <td class="border px-4 py-2">{{$assessment->assessmentRubric->name}}</td>
                                    <td class="border px-4 py-2">{{$assessment->assessment_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h4 class="text-bold">Portfolio Items</h4>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($reportCardData['portfolioItems'] as $item)
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="font-bold">{{$item->title}}</h4>
                                    <p>{{$item->description}}</p>
                                    @if ($item->item_type == 'file')
                                        <a href="{{asset('storage/'.$item->file_path)}}" target="_blank">View File</a>
                                    @else
                                        <a href="{{$item->url}}" target="_blank">View Link</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
