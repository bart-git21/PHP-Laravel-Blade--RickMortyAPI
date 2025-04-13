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
    public function selectLocationById($location_id)
    {
        return self::where('location_id', $location_id)->first();
    }
    public function insertLocation($location_id, $location_name, $residents, $location_url)
    {
        $data = [
            'location_id' => $location_id,
            'location_name' => $location_name,
            'residents' => $residents,
            'location_url' => $location_url,
        ];
        return self::create($data);
    }
}
