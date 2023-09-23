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
        Schema::create('asignaturas_por_asignacion', function (Blueprint $table) {
            $table->unsignedBigInteger('asignacion');
            $table->string('asignatura');
            $table->string('programa');
            $table->double('horas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas_por_asignacion');
    }
};
