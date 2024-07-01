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
        Schema::table('cuenta_corrientes', function (Blueprint $table) {
            $table->boolean('cierreCaja')->default(0); // Ajusta el tipo de dato según tus necesidades

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuenta_corrientes', function (Blueprint $table) {
            $table->dropColumn('cierreCaja');
        });
    }
};
