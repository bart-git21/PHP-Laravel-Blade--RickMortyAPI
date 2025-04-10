@extends('layouts.html')

@section('title', 'protected page')

@section('content')
    <h1>Hello, {{ auth()->user()->name }}, from protected page</h1>
@endsection