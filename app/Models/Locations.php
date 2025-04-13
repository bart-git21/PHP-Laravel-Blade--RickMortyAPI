<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Locations extends Model
{
    protected $table = 'locations';

    protected $fillable = ['location_id', 'location_name', 'residents', 'location_url'];

    protected $casts = [
        'residents' => 'array',
    ];
    public static function clearLocationsTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('locations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
