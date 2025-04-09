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

<div class="w-100 d-flex justify-content-around" id="arrows">
    @if ($offset > 0)
        <form class="form-content" action="/" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" min="1" max="51" name="episode" value="{{ $episode }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="offset" value="{{ ($offset - 1) >= 0 ?: 0 }}">
            <button type="submit" class="btn mb-3">
                <img width="40" height="40" src="https://img.icons8.com/flat-round/64/long-arrow-left.png"
                    alt="long-arrow-left" />
            </button>
        </form>
    @endif
    @if (($offset + 1) * $step < count($filteredCharacters))
        <form class="form-content" action="/" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" min="1" max="51" name="episode" value="{{ $episode }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="offset" value="{{ $offset + 1 }}">
            <button type="submit" class="btn mb-3">
                <img width="40" height="40" src="https://img.icons8.com/flat-round/64/long-arrow-right.png"
                    alt="long-arrow-right" />
            </button>
        </form>
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
    @foreach($characters as $single)
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