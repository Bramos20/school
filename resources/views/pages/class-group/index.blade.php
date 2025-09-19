@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> route('class-groups.index'), 'text'=> 'Levels' , 'active']
]])

@section('title', __('Levels'))

@section('page_heading', __('Levels'))

@section('content')
    @livewire('list-class-groups-table')
@endsection
