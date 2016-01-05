@extends('layouts.master')

@section('title','Main')

@section('content')

@stop
@section('scripts')
	@if (Session::has('success_message'))
		toastr.success('{{Session::get('success_message')}}');
	@endif
@stop