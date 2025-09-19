@extends('layouts.app', ['breadcrumbs' => [
        ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
        ['href'=> route('classes.index'), 'text'=> 'Grades' ],
        ['href'=> route('classes.edit', $myClass->id), 'text'=> "Edit $myClass->name" ]
]])
@section('title', __("Edit Grade $myClass->name"))

@section('page_heading',  __("Edit Grade $myClass->name "))

@section('content')
    @livewire('edit-class-form', ['myClass' => $myClass])
@endsection
