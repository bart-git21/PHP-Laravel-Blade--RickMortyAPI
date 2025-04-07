<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->name || $request->episode || $request->options || $request->location) {
            return view('home', ['name' => $request->name, 'episode' => $request->episode, 'options' => $request->options, 'location' => $request->location]);
        }
        return view('home', ['name' => "", 'episode' => "", 'options' => "", 'location' => ""]);
    }
}