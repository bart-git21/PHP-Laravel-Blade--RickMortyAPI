@extends('layouts.html')

@section('title', 'protected page')

@section('content')
    @php
        $user_id = Auth::id();
        $step = 10;
        $filteredCharacters = DB::table('characters')
            ->whereIn('character_id', function ($query) {
                $query->select('character_id')
                    ->from('favorite_characters')
                    ->where('user_id', Auth::id());
            })
            ->select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->orderBy('character_id', 'asc')
            ->get();
        $paginatedCharacters = DB::table('characters')
            ->whereIn('character_id', function ($query) {
                $query->select('character_id')
                    ->from('favorite_characters')
                    ->where('user_id', Auth::id());
            })
            ->select('characters.*', 'locations.location_name')
            ->leftJoin('locations', 'characters.location_id', '=', 'locations.location_id')
            ->orderBy('character_id', 'asc')
            ->get();
    @endphp

    <div class="container">
        <h1>Favorite characters</h1>
        <div class="row">
            <div class="">
                @include('partials.resulttable')
            </div>
        </div>
    </div>
@endsection