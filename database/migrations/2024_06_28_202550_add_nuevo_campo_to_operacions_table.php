<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::table('operacions', function (Blueprint $table) {
            $table->boolean('cerrado')->default(0); // Ajusta el tipo de dato según tus necesidades

        });
    }

    public function down(): void
    {
        Schema::table('operacions', function (Blueprint $table) {
            $table->dropColumn('cerrado');
        });
    }
};
