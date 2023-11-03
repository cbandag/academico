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
        Schema::create('jefes_por_periodo', function (Blueprint $table) {
            //$table->unsignedBigInteger('user_id');
            $table->string('identificacion_jefe');
            $table->string('identificacion_jefe_provisional')->nullable();
            $table->string('año');
            $table->string('periodo');
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('identificacion_jefe')->references('identificacion')->on('users');
            $table->unique(array('identificacion_jefe', 'año','periodo'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jefes_por_periodo');
    }
};
