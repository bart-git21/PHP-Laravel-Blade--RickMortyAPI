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
        Schema::create('character_test', function (Blueprint $table) {
            $table->id();
            $table->integer('character_id');
            $table->string('name');
            $table->string('status');
            $table->string('species');
            $table->string('gender');
            $table->integer('location_id');
            $table->json('episodes_id');
            $table->string('img_href');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_test');
    }
};
