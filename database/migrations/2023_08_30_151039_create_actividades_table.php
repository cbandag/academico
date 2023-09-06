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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodo');
            $table->unsignedBigInteger('docente');
            $table->unsignedBigInteger('jefe_inmediato');
            $table->string('tipo_docente');
            $table->double('horas_actividad');
            $table->double('tipo_actividad');
            $table->string('actividad');
            $table->double('totalh_docencia');
            $table->double('totalh_extension');
            $table->double('totalh_investigacion');
            $table->double('totalh_administrativa');
            $table->double('totalh_otros');
            $table->unsignedBigInteger('programa');
            $table->unsignedBigInteger('facultad');
            
            $table->foreign('periodo')->references('id')->on('periodos');
            $table->foreign('docente')->references('id')->on('users');
            $table->foreign('jefe_inmediato')->references('id')->on('users');
            $table->foreign('programa')->references('id')->on('programas');
            $table->foreign('facultad')->references('id')->on('facultades');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
