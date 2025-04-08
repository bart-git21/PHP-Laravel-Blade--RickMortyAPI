<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (
            $request->offset
            || $request->name
            || $request->episode
            || $request->options
            || $request->location
        ) {
            $offset = $request->offset ?: 0;
            return view('home', [
                'offset' => $offset,
                'name' => $request->name,
                'episode' => $request->episode,
                'options' => $request->options,
                'location' => $request->location
            ]);
        }
        return view('home', [
            'offset' => 0,
            'name' => "",
            'episode' => "",
            'options' => "",
            'location' => ""
        ]);
    }
}