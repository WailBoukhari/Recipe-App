<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['categories', 'ingredients'])->get();
        return view('home', compact('recipes'));
    }
}
