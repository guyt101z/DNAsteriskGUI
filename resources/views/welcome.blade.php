@extends('layouts.master')

@section('title', 'Test Title')

@section('topmenu')
    <p>This is the top menu</p>
@stop

@section('content')
    {!! Form::open() !!}
        
    {!! Form::close() !!}
@stop