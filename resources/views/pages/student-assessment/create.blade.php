@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> '#', 'text'=> 'Create Student Assessment' , 'active'],
]])

@section('title', __('Create Student Assessment'))

@section('page_heading',  __('Create Student Assessment'))

@section('content' )
    @livewire('create-student-assessment-form')
@endsection
