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
                        <img class="card-img-top position-relative" src="{{ $single->img_href }}" alt="">
                        <div class="position-absolute end-0">
                            @php
                                $favorite = $user_id && (DB::table('favorite_characters')->where('user_id', $user_id)->where('character_id', $single->character_id)->exists()) ? 'favorite' : ''
                            @endphp
                            <svg class="{{ $favorite }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none">
                                <path fill="white"
                                    d="M7 5a4 4 0 0 0-4 4c0 3.552 2.218 6.296 4.621 8.22A21.5 21.5 0 0 0 12 19.91a21.6 21.6 0 0 0 4.377-2.69C18.78 15.294 21 12.551 21 9a4 4 0 0 0-4-4c-1.957 0-3.652 1.396-4.02 3.2a1 1 0 0 1-1.96 0C10.652 6.396 8.957 5 7 5">
                                </path>
                                <path fill="black"
                                    d="M12 22c-.316-.02-.56-.147-.848-.278a23.5 23.5 0 0 1-4.781-2.942C3.777 16.705 1 13.449 1 9a6 6 0 0 1 6-6 6.18 6.18 0 0 1 5 2.568A6.18 6.18 0 0 1 17 3a6 6 0 0 1 6 6c0 4.448-2.78 7.705-5.375 9.78a23.6 23.6 0 0 1-4.78 2.942c-.543.249-.732.278-.845.278M7 5a4 4 0 0 0-4 4c0 3.552 2.218 6.296 4.621 8.22A21.5 21.5 0 0 0 12 19.91a21.6 21.6 0 0 0 4.377-2.69C18.78 15.294 21 12.551 21 9a4 4 0 0 0-4-4c-1.957 0-3.652 1.396-4.02 3.2a1 1 0 0 1-1.96 0C10.652 6.396 8.957 5 7 5">
                                </path>
                            </svg>
                        </div>
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

<style>
    .w-90 {
        width: 90px;
    }

    .card:hover {
        background-color: lightblue;
    }
</style>