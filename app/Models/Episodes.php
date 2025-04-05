<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class episodes extends Model
{
    protected $table = 'episode_test';

    protected $fillable = ['eposide_id', 'name', 'url', 'air_date', 'characters'];

    protected $casts = [
        'characters' => 'array',
    ];
}
