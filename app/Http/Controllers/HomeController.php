<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Characters;
use App\Models\FavoriteCharacters;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $offset = $request->offset ?: 0;
        $name = $request->name ?: '';
        $episode = $request->episode ?: '';
        $options = $request->options ?: '';
        $location = $request->location ?: '';
        $step = 10;
        $characters = new Characters();
        $allCharacters = $characters->getAllCharacters();
        $paginatedCharacters = $characters->getPaginatedCharacters($offset, $step, $name, $options, $episode, $location);
        $filteredCharactersCount = $characters->getFilteredCharactes($name, $options, $episode, $location)->count();

        foreach ($paginatedCharacters as $character) {
            $character->favorite = !$user_id
                ? ''
                : (FavoriteCharacters::where('character_id', $character->character_id)->where('user_id', $user_id)->first()
                    ? 'favorite'
                    : '');
        }
        return view('home', [
            'allCharacters' => $allCharacters,
            'allCharactersCount' => $allCharacters->count(),
            'filteredCharactersCount' => $filteredCharactersCount,
            'paginatedCharacters' => $paginatedCharacters,
            'offset' => $offset,
            'step' => $step,
            'name' => $name,
            'episode' => $episode,
            'options' => $options,
            'location' => $location,
        ]);
    }
}