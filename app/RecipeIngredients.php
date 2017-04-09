<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredients extends Model
{
    public function ingredientsList() {
        return $this->belongsTo("App\\RecipeIngredientList");
    }
}
