<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeRating
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $user_id
 * @property int $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Recipe $recipe
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeRating whereUserId($value)
 * @mixin \Eloquent
 */
class RecipeRating extends Model
{
    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }

    public function user() {
        return $this->belongsTo("App\\User");
    }
}
