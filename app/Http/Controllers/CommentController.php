<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Add a comment to the specified recipe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, Recipe $recipe)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to comment on this recipe.');
        }
        // Create the comment
        $comment = $recipe->comments()->create([
            'user_id' => auth()->id(), // Assuming users are authenticated before commenting
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
