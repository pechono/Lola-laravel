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
        Schema::create('oferta_articulos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('oferta_id')->default(0);
            $table->integer('articulo');
            $table->float('cantidad')->default(0);
            $table->float('precioI')->default(0);
            $table->float('precioF')->default(0);
            $table->float('precioO')->default(0);
            $table->timestamps();
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_articulos');
    }
};
