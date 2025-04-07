@extends('layouts.html')

@section('title', 'rick morty application')

@section('content')
    <style>
        body {
            /* background-color: chocolate; */
        }

        .form-content {
            background-color: #2c3034;
            color: #fff;
            padding: 40px;
            border: 3px solid #fff;
            border-radius: 10px;

            & h3 {
                font-size: 28px;
                font-weight: 600;
                margin-bottom: 25px;
            }
        }

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
            ->select('character_test.*', 'location_test.location_name')
            ->leftJoin('location_test', 'character_test.location_id', '=', 'location_test.location_id')
            ->where('location_name', 'LIKE', "%$location%")
            ->whereBetween('character_test.character_id', [1, 20])
            ->get();
    @endphp

    <div class="container">
        <h1 class="text-center">Rick & Morty Characters</h1>
        @if (DB::table('character_test')->count() > 0)
            <div class="row align-items-start">
                <div class="col-4">
                    <form class="form-content" action="/" method="post">
                        <h3 class="text-center">Custom characters</h3>
                        @csrf
                        <div class="">
                            <label for="name" class="form-label">Name :</label>
                            <input type="text" name="name" placeholder="Rick">
                        </div>

                        <div class="">
                            <label for="location" class="form-label">Location :</label>
                            <input type="text" name="location" placeholder="Earth">
                        </div>

                        <div class="">
                            <select class="form-select" name="options" aria-label="Default select example">
                                <option selected disabled>Status :</option>
                                <option value="alive">alive</option>
                                <option value="dead">dead</option>
                                <option value="unknown">unknown</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <form class="mb-3" action="/export" method="post">
                        @csrf
                        <input type="hidden" name="table" value="{{ $characters }}">

                        <button type="submit" class="btn btn-outline-success"><img
                                src="{{ asset('images/icons8-excel-48.png') }}" alt="">Export to Excel</button>
                    </form>
                </div>
                <div class="col-8">
                    @if ($name)
                        <p>You chosen {{ $name }} name.</p>
                    @endif
                    @if ($location)
                        <p>You chosen {{ $location }} location.</p>
                    @endif
                    @if ($options)
                        <p>You chosen {{ $options }} status.</p>
                    @endif

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
                </div>
            </div>
        @else
            <form action="{{route('rickmortyapi.store')}}" method="GET">
                @csrf
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Получить данные</button>
                </div>
            </form>
        @endif
    </div>

    <footer>icons by <a target="_blank" rel="noopener noreferrer" href="https://icons8.com">Icons8</a></footer>
@endsection