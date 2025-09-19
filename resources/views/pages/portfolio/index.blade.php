@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> '#', 'text'=> 'Portfolio' , 'active'],
]])

@section('title', __('Student Portfolio'))

@section('page_heading',  __('Student Portfolio'))

@section('content' )
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$student->name}}'s Portfolio</h3>
        </div>
        <div class="card-body">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($portfolioItems as $item)
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
    </div>
@endsection
