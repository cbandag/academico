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
            $table->string('dedicacion');
            $table->string('horas_dedicacion');
            $table->string('porcentaje_total_funciones');
            $table->string('descarga_investigacion');
            $table->string('porcentaje_investigacion');
            $table->string('descarga_extension');
            $table->string('porcentaje_extension');
            $table->string('total_descargas');
            $table->string('horas_restantes');
            $table->double('horas');
            $table->double('total_horas');
            $table->string('año');
            $table->string('periodo');

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
