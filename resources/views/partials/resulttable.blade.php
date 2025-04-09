<style>
    .w-90 {
        width: 90px;
    }

    .card:hover {
        background-color: lightblue;
    }
</style>

<table class="table table-dark table-striped table-hover table-bordered border-primary">
    <thead class="table-light text-center fs-5">
        <th>id</th>
        @if ($name)
            <th>You chosen "{{ $name }}" name</th>
        @else
            <th>Name</th>
        @endif
        @if ($options)
            <th>You chosen "{{ $options }}" status</th>
        @else
            <th>Status</th>
        @endif
        @if ($location)
            <th>You chosen #{{ $location }} location</th>
        @else
            <th>Location</th>
        @endif
        @if ($episode)
            <th>You chosen #{{ $episode }} episode</th>
        @else
            <th>Episodes</th>
        @endif
    </thead>
    @foreach($paginatedCharacters as $single)
        <tr>
            <td>{{ $single->character_id }}</td>
            <td class="p-0 w-90">
                <a class="text-decoration-none"
                    href="https://rickandmortyapi.com/api/character/{{ $single->character_id }}">
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