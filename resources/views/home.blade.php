@extends('layouts.html')

@section('title', 'rick morty application')

@section('content')
    <div class="container">
        <h1 class="text-center my-3">Rick & Morty Characters</h1>
        @if ($allCharactersCount > 0)
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8">
                    @include('partials.paginationform')
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    @include('partials.filterform')
                    @include('partials.excelform')
                </div>
                <div class="col-8">
                    @include('partials.resulttable')
                    @include('partials.loadingform', ['buttonId' => 'updateJob', 'buttonText' => 'Обновить данные'])
                </div>
            </div>
        @else
            @include('partials.loadingform', ['buttonId' => 'dispatchJob', 'buttonText' => 'Получить данные'])
        @endif
    </div>
@endsection