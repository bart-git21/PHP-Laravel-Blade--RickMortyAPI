<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('favorite_characters', function (Blueprint $table) {
            $table->integer('character_id')->index()->after('user_id');
            $table->foreign('character_id')->references('character_id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favorite_characters', function (Blueprint $table) {
            $table->dropColumn('character_id');
        });
    }
};
