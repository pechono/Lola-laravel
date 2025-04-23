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
        Schema::create('service_operacions', function (Blueprint $table) {
            $table->id();
            $table->integer('userMec');
            $table->float('precio')->default(0);
            $table->integer('clientes_id');
            $table->string('bike')->nullable();
            $table->string('detalles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_operacions');
    }
};
