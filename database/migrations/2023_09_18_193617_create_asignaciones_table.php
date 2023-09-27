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
            $table->string('horas_dedicacion')->nullable();
            /*$table->unsignedBigInteger('funcion_1')->nullable();
            $table->unsignedBigInteger('funcion_2')->nullable();
            $table->unsignedBigInteger('funcion_3')->nullable();
            $table->unsignedBigInteger('funcion_4')->nullable();*/
            $table->string('descarga_investigacion')->nullable();
            $table->string('porcentaje_investigacion')->nullable();
            $table->string('descarga_extension')->nullable();
            $table->string('porcentaje_extension')->nullable();
            $table->string('total_descargas')->nullable();
            $table->double('horas_restantes')->nullable();
            $table->string('soporte')->nullable();
            $table->double('horas_clases')->nullable();
            $table->double('horas_preparacion')->nullable();
            $table->double('horas_estudiantes')->nullable();
            $table->string('observaciones')->nullable();
            $table->double('horas_docencia')->nullable();
            $table->string('año');
            $table->string('periodo');
            $table->string('estado');

            $table->timestamps();

            /*$table->foreign('funcion_1')->references('id')->on('funciones');
            $table->foreign('funcion_2')->references('id')->on('funciones');
            $table->foreign('funcion_3')->references('id')->on('funciones');
            $table->foreign('funcion_4')->references('id')->on('funciones');*/

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
