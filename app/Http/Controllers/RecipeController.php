<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $recipes = Recipe::all();
        return view('recipe.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipe.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'category' => 'required|string',
            'ingredients' => 'required|array',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); // Move uploaded file to public/images directory
        } else {
            // Handle no image uploaded case
            $imageName = null;
        }

        // Save the recipe to the database
        $recipe = new Recipe();
        $recipe->user_id = auth()->id();
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->content = $request->content;
        $recipe->img = 'images/' . $imageName; // Save the image path relative to public directory
        $recipe->save();

        // Associate the recipe with categories
        $recipe->categories()->sync($request->category);

        // Associate the recipe with ingredients
        $recipe->ingredients()->attach($request->ingredients);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipe.edit', compact('recipe', 'categories', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'categories' => 'required|array',
            'ingredients' => 'required|array',
        ]);

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); // Move uploaded file to public/images directory

            // Update the image path
            $recipe->img = 'images/' . $imageName;
        }

        // Update the recipe details
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->content = $request->content;
        $recipe->save();

        // Update the associations with categories
        $recipe->categories()->sync($request->categories);

        // Update the associations with ingredients
        $recipe->ingredients()->sync($request->ingredients);

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query
        $recipes = Recipe::where('title', 'like', "%$query%")
            // ->orWhere('category', 'like', "%$query%")
            // ->orWhere('ingredients', 'like', "%$query%")
            ->get();

        return view('search', compact('recipes'));
    }



}
