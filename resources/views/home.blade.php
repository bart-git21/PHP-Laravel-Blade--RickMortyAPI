@extends('layouts.html')

@section('title', 'rick morty application')

@section('content')
    @php
        $characters = DB::table('characters')
            ->where('name', 'LIKE', "%$name%")
            ->where('status', 'LIKE', "%$options%")
            ->when($episode, function ($query) use ($episode) {
                return $query->whereRaw('JSON_CONTAINS(episodes_id, CAST(? AS JSON))', [$episode]);
            })
            ->select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->where('location_name', 'LIKE', "%$location%")
            ->orderBy('character_id', 'asc')
            ->get();
    @endphp

    <div class="container">
        <h1 class="text-center mb-5">Rick & Morty Characters</h1>
        @if (DB::table('characters')->count() > 0)
            <div class="row align-items-start">
                <div class="col-4">
                    @include('partials.filterform')
                    @include('partials.excelform')
                </div>
                <div class="col-8">
                    @include('partials.resulttable')
                </div>
            </div>
        @else
            @include('partials.loadingform')
        @endif
    </div>
@endsection