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
        Schema::create('carnet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('pdf'); // Ruta del archivo PDF
            $table->date('fecha_soat'); // Campo para la fecha de SOAT
            $table->string('placa');
            $table->string('gremio');
            $table->boolean('estado'); // Estado del carné
            $table->string('fotocarnet'); // Agrega la columna fotocarnet
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnet');
    }
};
