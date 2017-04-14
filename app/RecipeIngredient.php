<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeIngredients
 *
 * @property int $id
 * @property int $recipe_ingredient_list_id
 * @property string $name
 * @property string $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\RecipeIngredientList $ingredientsList
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereRecipeIngredientListId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeIngredient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeIngredient extends Model
{
    protected $fillable = [
        "name",
        "amount",
    ];

    public function ingredientsList() {
        return $this->belongsTo("App\\RecipeIngredientList");
    }
}
