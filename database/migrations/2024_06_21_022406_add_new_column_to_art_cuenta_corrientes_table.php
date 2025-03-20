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
        Schema::table('art_cuenta_corrientes', function (Blueprint $table) {
            $table->float('precioI');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('art_cuenta_corrientes', function (Blueprint $table) {
               $table->dropColumn('precioI');

        });
    }
};
