<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeTag
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $user_id
 * @property string $tag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Recipe $recipe
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereTag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeTag whereUserId($value)
 * @mixin \Eloquent
 */
class RecipeTag extends Model
{
    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }

    public function user() {
        return $this->belongsTo("App\\User");
    }
}
