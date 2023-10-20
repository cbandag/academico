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
            $table->string('identificacion_docente')->unique();
            $table->string('horas_dedicacion')->nullable();
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
            $table->double('horas_preparacion_ajustada')->nullable();
            $table->double('horas_estudiantes_ajustada')->nullable();
            $table->string('observaciones')->nullable();
            $table->double('horas_docencia')->nullable();
            $table->string('identificacion_jefe')->nullable();
            $table->string('año');
            $table->string('periodo');
            $table->string('estado');


            $table->timestamps();

            $table->foreign('identificacion_docente')->references('identificacion')->on('users');
            $table->foreign('identificacion_jefe')->references('identificacion')->on('users');
            $table->unique(array('identificacion_docente', 'año','periodo'));

           /* $table->foreign('funcion_2')->references('id')->on('funciones');
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
