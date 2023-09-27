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
        Schema::create('funciones_por_asignacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asignacion_id');
            $table->unsignedBigInteger('funcion_id');

            $table->timestamps();

            $table->foreign('asignacion_id')->references('id')->on('asignaciones');
            $table->foreign('funcion_id')->references('id')->on('funciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funciones_por_docente');
    }
};
