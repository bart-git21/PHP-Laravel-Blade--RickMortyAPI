<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    protected $table = 'characters';

    protected $fillable = ['name', 'status', 'species', 'gender', 'location_id', 'episodes_id' => 'array', 'img_href'];
}
