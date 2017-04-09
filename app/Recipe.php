<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function ingredientLists() {
        return $this->hasMany("App\\RecipeIngredientList");
    }

    public function ratings() {
        return $this->hasMany("App\\RecipeRating");
    }

    public function steps() {
        return $this->hasMany("App\\RecipeStep");
    }

    public function favorites() {
        return $this->hasMany("App\\Favorite");
    }

    public function user() {
        return $this->belongsTo("App\\User");
    }
}
