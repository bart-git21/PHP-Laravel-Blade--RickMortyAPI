@extends('layouts.html')

@section('title', 'rick morty application')

@section('content')
    <style>
        .w-90 {
            width: 90px;
        }

        .card:hover {
            background-color: lightblue;
        }
    </style>
    @php
        $characters = DB::table('character_test')
            ->where('name', 'LIKE', "%$name%")
            ->where('status', 'LIKE', "%$options%")
            ->whereBetween('character_test.character_id', [0, 33])
            ->select('character_test.*', 'location_test.location_name')
            ->leftJoin('location_test', 'character_test.location_id', '=', 'location_test.location_id')
            ->where('location_name', 'LIKE', "%$location%")
            ->get();
    @endphp

    <div class="container">
        <h1 class="text-center">Characters</h1>
        <div class="row align-items-start">
            <div class="col-3">
                <form class="" action="/" method="post">
                    @csrf
                    <div class="">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" name="name" placeholder="Rick">
                    </div>

                    <div class="">
                        <label for="location" class="form-label">Location :</label>
                        <input type="text" name="location" placeholder="Earth">
                    </div>

                    <div class="row">
                        <select class="form-select" name="options" aria-label="Default select example">
                            <option selected disabled>Status :</option>
                            <option value="alive">alive</option>
                            <option value="dead">dead</option>
                            <option value="unknown">unknown</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="col-9">
                @if (DB::table('character_test')->count() > 0)
                    @if ($name)
                        <p>name = {{ $name }}</p>
                    @endif
                    @if ($location)
                        <p>location = {{ $location }}</p>
                    @endif
                    @if ($options)
                        <p>status = {{ $options }}</p>
                    @endif

                    <form class="mb-3" action="/export" method="post">
                        @csrf
                        <input type="hidden" name="table" value="{{ $characters }}">
                        <button type="submit" class="btn btn btn-outline-primary">Export to Excel</button>
                    </form>

                    <table class="table table-dark table-striped table-hover table-bordered border-primary">
                        <thead class="table-dark text-center">
                            <th>id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Episodes</th>
                        </thead>
                        @foreach($characters as $key => $single)
                            <tr>
                                <td>{{ $single->character_id }}</td>
                                <td class="p-0 w-90">
                                    <a class="text-decoration-none"
                                        href="https://rickandmortyapi.com/api/episode/{{ $single->character_id }}">
                                        <div class="card text-center" style="width: 10rem;">
                                            <img class="card-img-top" src="{{ $single->img_href }}" alt="">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $single->name }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $single->status }}</td>
                                <td>{{ $single->location_name }}</td>
                                <td>{{ $single->episodes_id }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <form action="{{route('rickmortyapi.store')}}" method="GET">
                        @csrf
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Получить данные</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection