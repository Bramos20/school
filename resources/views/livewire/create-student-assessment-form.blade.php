<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Student Assessment</h3>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" class="md:w-1/2">
            <x-display-validation-errors/>

            <x-select id="class" name="class_id" label="Grade *" wire:model.live="class" >
                @foreach ($classes as $class)
                    <option value="{{$class->id}}">{{$class->name}}</option>
                @endforeach
            </x-select>

            <x-select id="section" name="section_id" label="Stream *" wire:model.live="section" >
                @foreach ($sections as $section)
                    <option value="{{$section->id}}">{{$section->name}}</option>
                @endforeach
            </x-select>

            <x-select id="student" name="user_id" label="Student *" multiple wire:model="students">
                @foreach ($students as $student)
                    <option value="{{$student->id}}">{{$student->name}}</option>
                @endforeach
            </x-select>

            <x-select id="academic-year" name="academic_year_id" label="Academic Year *" wire:model="academicYears">
                @foreach ($academicYears as $academicYear)
                    <option value="{{$academicYear->id}}">{{$academicYear->name}}</option>
                @endforeach
            </x-select>

            <x-select id="semester" name="semester_id" label="Semester *" wire:model="semesters">
                @foreach ($semesters as $semester)
                    <option value="{{$semester->id}}">{{$semester->name}}</option>
                @endforeach
            </x-select>

            <x-input type="date" id="assessment-date" name="assessment_date" label="Assessment Date *" wire:model="assessment_date"/>

            <h4 class="text-bold text-xl md:text-3xl font-bold col-span-12 text-center my-2">Competencies</h4>

            @foreach ($competencies as $competency)
                <x-select id="competency-{{$competency->id}}" name="competencies[{{$competency->id}}]" label="{{$competency->name}} *" wire:model="competencies.{{$competency->id}}">
                    @foreach ($rubrics as $rubric)
                        <option value="{{$rubric->id}}">{{$rubric->name}}</option>
                    @endforeach
                </x-select>
            @endforeach

            <x-textarea id="remarks" name="remarks" label="Remarks" wire:model="remarks"/>

            @csrf
            <x-button label="Create" theme="primary" icon="fas fa-key" type="submit" class="w-full md:w-1/2"/>
        </form>
    </div>
</div>
