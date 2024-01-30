<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_category');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * Calculate the average rating for the recipe.
     *
     * @return float
     */
    public function averageRating()
    {
        $totalRatings = $this->ratings()->count();

        if ($totalRatings === 0) {
            return 0;
        }

        $sumRatings = $this->ratings()->sum('rating');
        $averageRating = $sumRatings / $totalRatings;

        return $averageRating;
    }
}
