<style>
    .w-90 {
        width: 90px;
    }

    .card:hover {
        background-color: lightblue;
    }
</style>
<div>
    @if ($name)
        <p>You chosen {{ $name }} name.</p>
    @endif
    @if ($episode)
        <p>You chosen {{ $episode }} episode.</p>
    @endif
    @if ($location)
        <p>You chosen {{ $location }} location.</p>
    @endif
    @if ($options)
        <p>You chosen {{ $options }} status.</p>
    @endif
</div>

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
                <a class="text-decoration-none" href="https://rickandmortyapi.com/api/episode/{{ $single->character_id }}">
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