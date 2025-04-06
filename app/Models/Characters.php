<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    protected $table = 'character_test';

    protected $fillable = ['character_id', 'name', 'status', 'species', 'gender', 'location_id', 'episodes_id', 'img_href'];

    protected $casts = [
        'episodes_id' => 'array'
    ];
}
