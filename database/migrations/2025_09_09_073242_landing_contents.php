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
        // database/migrations/xxxx_create_landing_contents.php
Schema::create('landing_contents', function (Blueprint $table) {
    $table->id();
    $table->string('section'); // hero, fitur, integrasi, testimoni, faq, dsb
    $table->string('title')->nullable();
    $table->text('content')->nullable();
    $table->string('image')->nullable();
    $table->integer('order')->default(0);
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};