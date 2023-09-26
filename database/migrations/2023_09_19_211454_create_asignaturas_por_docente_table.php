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
        Schema::create('asignaturas_por_docente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identificacion');
            $table->string('codigo_asignatura');
            $table->string('asignatura');
            $table->string('grupo');
            $table->string('programa');
            $table->double('horas');
            $table->double('año');
            $table->double('periodo');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas_por_docente');
    }
};
