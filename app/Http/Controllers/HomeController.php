<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->name || $request->options || $request->location) {
            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'location' => 'string|max:255',
            ]);
            return view('home', ['name' => $validatedData['name'], 'options' => $request->options, 'location' => $validatedData['location']]);
        }
        return view('home', ['name' => "", 'options' => "", 'location' => ""]);
    }
}