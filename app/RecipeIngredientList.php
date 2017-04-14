<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeIngredientList
 *
 * @property int $id
 * @property int $recipe_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeIngredients[] $ingredients
 * @property-read \App\Recipe $recipe
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredientList whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredientList whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredientList whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredientList whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredientList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeIngredientList extends Model
{
    protected $fillable = [
        "name",
    ];

    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }

    public function ingredients() {
        return $this->hasMany("App\\RecipeIngredient");
    }
}
