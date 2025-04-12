<div class="w-100 d-flex justify-content-around" id="arrows">
    @if ($offset > 0)
        <form class="form-content" action="/" method="post">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" min="1" max="51" name="episode" value="{{ $episode }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="options" value="{{ $options }}">
            <input type="hidden" name="offset" value="{{ $offset - 1 }}">
            <button type="submit" class="btn mb-3">
                <img width="40" height="40" src="https://img.icons8.com/flat-round/64/long-arrow-left.png"
                    alt="long-arrow-left" />
            </button>
        </form>
    @endif
    @if (($offset + 1) * $step < $filteredCharactersCount)
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