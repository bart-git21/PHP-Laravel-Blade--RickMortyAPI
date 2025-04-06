<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'location_test';

    protected $fillable = ['location_id', 'location_name', 'residents', 'location_url'];

    protected $casts = [
        'residents' => 'array',
    ];
}
