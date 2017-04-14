<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Favorite
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Recipe $recipe
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereUserId($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    public function recipe() {
        return $this->belongsTo("App\\Recipe");
    }

    public function user() {
        return $this->belongsTo("App\\User");
    }
}
