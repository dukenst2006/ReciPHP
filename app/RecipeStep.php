<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeStep
 *
 * @property int $id
 * @property int $recipe_id
 * @property string $name
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Recipe $recipe
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecipeStep whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeStep extends Model
{
    protected $fillable = [
        "title",
        "body",
    ];

    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }
}
