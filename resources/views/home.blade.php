<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>rick morty application</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <style>
        .w-90 {
            width: 90px;
        }

        .card:hover {
            background-color: lightblue;
        }
    </style>
</head>

<body>
    @php
        $characters = DB::table('character_test')
            ->where('name', 'LIKE', "%$name%")
            ->where('status', 'LIKE', "%$options%")
            ->where('location_name', 'LIKE', "%$location%")
            ->whereBetween('character_test.character_id', [0, 33])
            ->select('character_test.*', 'location_test.location_name')
            ->leftJoin('location_test', 'character_test.location_id', '=', 'location_test.location_id')
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>