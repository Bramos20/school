@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
        ['href'=> route('classes.index'), 'text'=> ' Grades' ,],
        ['href'=> route('classes.create'), 'text'=> 'Create' , 'active'],
]])

@section('title',__('Create Grade'))

@section('page_heading',__('Create Grade'))

@section('content')
    @livewire('create-class-form')
@endsection
