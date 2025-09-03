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
       Schema::create('products', function (Blueprint $table){
        $table->id();
        $table->string('product');
        $table->string('name');
        $table->enum('category',['mekanis','elektrikal','piping','aksesoris','umum']);
        $table->string('suppliers_id');
        $table->string('stock');
        $table->string('satuan');
        $table->text('deskripsi');
        $table->string('lokasi_penyimpanan');
        $table->string('image');
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



