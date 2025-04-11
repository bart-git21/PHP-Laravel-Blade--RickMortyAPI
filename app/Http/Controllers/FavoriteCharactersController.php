<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCharacters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteCharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('favorite', [
            'offset' => 0,
            'name' => "",
            'episode' => "",
            'options' => "",
            'location' => ""
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        FavoriteCharacters::create([
            'user_id' => Auth::id(),
            'character_id' => $request->character_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FavoriteCharacters::where('user_id', Auth::id())->where('character_id', $request->character_id)->delete();
    }
}
