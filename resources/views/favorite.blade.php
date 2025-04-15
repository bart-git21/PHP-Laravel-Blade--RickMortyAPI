@extends('layouts.html')

@section('title', 'protected page')

@section('content')
    <div class="container">
        <h1>Favorite characters</h1>
        <div class="row">
            <div class="">
                @include('partials.resulttable')
            </div>
        </div>
    </div>
@endsection