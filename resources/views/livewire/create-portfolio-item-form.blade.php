<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add Portfolio Item</h3>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" class="md:w-1/2" enctype="multipart/form-data">
            <x-display-validation-errors/>

            <x-select id="student" name="user_id" label="Student *" wire:model.live="studentId">
                @foreach ($students as $student)
                    <option value="{{$student->id}}">{{$student->name}}</option>
                @endforeach
            </x-select>

            <x-select id="subject" name="subject_id" label="Subject *" wire:model.live="subjectId">
                @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </x-select>

            <x-input id="title" name="title" label="Title *" wire:model.live="title"/>
            <x-textarea id="description" name="description" label="Description" wire:model.live="description"/>

            <x-select id="item-type" name="item_type" label="Item Type *" wire:model.live="itemType">
                <option value="file">File</option>
                <option value="link">Link</option>
            </x-select>

            @if ($itemType == 'file')
                <x-input type="file" id="file" name="file" label="File *" wire:model.live="file"/>
            @else
                <x-input type="url" id="url" name="url" label="URL *" wire:model.live="url"/>
            @endif

            @csrf
            <x-button label="Add" theme="primary" icon="fas fa-key" type="submit" class="w-full md:w-1/2"/>
        </form>
    </div>
</div>
