<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Rate the specified recipe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, Recipe $recipe)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to rate a recipe.');
        }

        // Create or update the rating
        $rating = $recipe->ratings()->updateOrCreate(
            ['user_id' => Auth::id()], // Set the user_id based on the authenticated user
            ['rating' => $request->rating]
        );
        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }

}
