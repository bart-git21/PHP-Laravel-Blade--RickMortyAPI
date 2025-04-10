<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCharacters extends Model
{
    protected $table = 'favorite_characters';
    protected $fillable = ['user_id', 'character_id'];
}
