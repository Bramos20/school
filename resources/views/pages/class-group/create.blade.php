@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
        ['href'=> route('class-groups.index'), 'text'=> 'Levels' ],
        ['href'=> route('class-groups.create'), 'text'=> 'Create', 'active'],
]])

@section('title',__('Create Level'))

@section('page_heading',__('Create Level'))

@section('content')
    @livewire('create-class-group-form')
@endsection
