@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
        ['href'=> route('sections.index'), 'text'=> 'Streams', 'active']
]])

@section('title', __('Streams'))

@section('page_heading',  __('Streams'))

@section('content', )
    @livewire('list-sections-table')
@endsection