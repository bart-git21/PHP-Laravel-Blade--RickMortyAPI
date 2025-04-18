<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->integer('location_id')->nullable()->change();
            $table->foreign('location_id')->references('location_id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('location_id')->nullable()->change();
            $table->dropForeign(['location_id']);
            $table->unsignedBigInteger('location_id')->nullable()->change();
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }
};
