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
        Schema::connection('pgsql')->dropIfExists('programaciones');
        Schema::connection('pgsql')->create('programaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_programa');
            $table->string('programa');
            $table->string('codigo_materia');
            $table->string('materia');
            $table->string('grupo');
            $table->string('semestre');
            $table->string('tipo');
            $table->string('ide');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('npqprf');
            $table->string('semanas');
            $table->double('horas');
            $table->unsignedBigInteger('creditos');
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
        Schema::connection('pgsql')->dropIfExists('programaciones');
    }
};
