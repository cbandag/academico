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
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificacion');
            $table->string('dedicacion')->nullable();
            $table->string('horas_dedicacion')->nullable();
            $table->string('porcentaje_total_funciones')->nullable();
            $table->string('descarga_investigacion')->nullable();
            $table->string('porcentaje_investigacion')->nullable();
            $table->string('descarga_extension')->nullable();
            $table->string('porcentaje_extension')->nullable();
            $table->string('total_descargas')->nullable();
            $table->double('horas_restantes')->nullable();
            $table->double('soporte')->nullable();
            $table->double('horas_clases')->nullable();
            $table->double('horas_preparacion')->nullable();
            $table->double('horas_estudiantes')->nullable();
            $table->double('observaciones')->nullable();
            $table->string('año');
            $table->string('periodo');
            $table->string('estado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
