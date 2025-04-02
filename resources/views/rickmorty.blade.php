<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty</title>
</head>

<body>
    <h1>Characters</h1>

    @if(!empty($characters))
    <h1>{{ $characters[0]["name"] }}</h1>
        <ul>
            @foreach($characters as $character)
                <li>
                    <h2>{{ $character['name'] }}</h2>
                    <img src="{{ $character['image'] }}" alt="">
                    <p>status - {{ $character['status'] }}</p>
                    <p>species - {{ $character['species'] }}</p>
                    <p>gender - {{ $character['gender'] }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>No characters found.</p>
    @endif

</body>

</html>