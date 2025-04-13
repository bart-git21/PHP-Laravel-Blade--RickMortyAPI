<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FavoriteCharacters extends Model
{
    protected $table = 'favorite_characters';
    protected $fillable = ['user_id', 'character_id'];
    public static function clearFavoriteCharactersTable() {
        DB::table('favorite_characters')->truncate();
    }
}
