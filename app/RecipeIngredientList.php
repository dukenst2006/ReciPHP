<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredientList extends Model
{
    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }

    public function ingredients() {
        return $this->hasMany("App\\RecipeIngredients");
    }
}
