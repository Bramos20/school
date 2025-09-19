@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> '#', 'text'=> 'Add Portfolio Item' , 'active'],
]])

@section('title', __('Add Portfolio Item'))

@section('page_heading',  __('Add Portfolio Item'))

@section('content' )
    @livewire('create-portfolio-item-form')
@endsection
