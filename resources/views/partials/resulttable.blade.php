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
    @php
        $left_offset = ($offset - $step) >= 0 ? ($offset - 1) : 0;
        $right_offset = ($step < count($characters)) ? ($offset + 1) : count($characters);
    @endphp
    @if ($offset > 0)
        <form class="form-content" action="/" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" min="1" max="51" name="episode" value="{{ $episode }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="offset" value="{{ $left_offset }}">
            <button type="submit" class="btn btn-primary mb-3">left</button>
        </form>
    @endif
    @if ($step < count($characters))
        <form class="form-content" action="/" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" min="1" max="51" name="episode" value="{{ $episode }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="offset" value="{{ $right_offset }}">
            <button type="submit" class="btn btn-primary mb-3">right</button>
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