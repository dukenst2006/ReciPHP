<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Recipe
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeIngredientList[] $ingredientLists
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeRating[] $ratings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeStep[] $steps
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recipe whereUserId($value)
 * @mixin \Eloquent
 */
class Recipe extends Model
{
    protected $fillable = [
        "name",
        "description",
    ];

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

    public function tags() {
        return $this->hasMany("App\\RecipeTag");
    }

    public function user() {
        return $this->belongsTo("App\\User");
    }
}
