<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Characters;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $offset = $request->offset ?: 0;
        $name = $request->name ?: '';
        $episode = $request->episode ?: '';
        $options = $request->options ?: '';
        $location = $request->location ?: '';
        $step = 10;
        $characters = new Characters();
        $allCharacters = $characters->getAllCharacters();
        $paginatedCharacters = $characters->getPaginatedCharacters($offset, $step, $name, $options, $episode, $location);
        $filteredCharacters = $characters->getFilteredCharactes($name, $options, $episode, $location);

        return view('home', [
            'allCharacters' => $allCharacters,
            'filteredCharacters' => $filteredCharacters,
            'paginatedCharacters' => $paginatedCharacters,
            'allCharactersCount' => $allCharacters->count(),
            'offset' => $offset,
            'step' => $step,
            'filteredCharactersCount' => $filteredCharacters->count(),
            'name' => $name,
            'episode' => $episode,
            'options' => $options,
            'location' => $location,
            'user_id' => Auth::id(),
        ]);
    }
}