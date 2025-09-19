@extends('layouts.app', ['breadcrumbs' => [
        ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
        ['href'=> route('sections.index'), 'text'=> 'Streams'],
        ['href'=> route('sections.create'), 'text'=> 'Create', 'active'],
]])

@section('title', __('Create Stream'))

@section('page_heading',  __('Create Stream'))

@section('content' )
    @livewire('create-section-form')
@endsection