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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id('idHospital');
            $table->string('Nombre');
            $table->string('Mes');
            $table->integer('NumeroCasos');
            $table->integer('NumeroCubrebocas');
            $table->integer('NumeroMascarillas');
            $table->integer('NumeroCaretas');
            $table->integer('Empleados');
            $table->string('Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
