<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit {{$section->name}}</h3>
    </div>
    <div class="card-body">
        <form action="{{route('sections.update', $section->id)}}" method="POST" class="md:w-6/12">
            <x-display-validation-errors />
            <x-input id="name" name="name" label="Stream name" placeholder="Enter stream name" value="{{$section->name}}" />
            @csrf
            <x-input  id="class" name="class" label="Stream Grade" placeholder="Enter stream grade" value="{{$section->myClass->name}}" disabled/>
            @method('put')
            <x-button label="Edit" theme="primary" icon="fas fa-key" type="submit" class="w-full md:w:1/2"/>
        </form>
    </div>
</div>
