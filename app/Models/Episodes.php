<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class episodes extends Model
{
    protected $table = 'episodes';

    protected $fillable = ['eposide_id', 'name', 'url', 'air_date', 'characters'];

    protected $casts = [
        'characters' => 'array',
    ];
    public static function clearEpisodesTable() {
        DB::table('episodes')->truncate();
    }
}
