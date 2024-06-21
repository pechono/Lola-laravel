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
           $table->float('deuda');
           $table->boolean('cerrado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuenta_corrientes', function (Blueprint $table) {
            $table->dropColumn('deuda');
            $table->dropColumn('cerrado');
        });
    }
};
