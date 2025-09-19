@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> route('classes.index'), 'text'=> 'Grades' , 'active']
]])

@section('title', __('Grades'))

@section('page_heading', __('Grades'))

@section('content')
    @livewire('list-classes-table')
@endsection
