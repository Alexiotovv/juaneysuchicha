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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 100)->nullable()->default('');
            $table->string('nombres', 250)->nullable()->default('');
            $table->string('apellido_paterno', 250)->nullable()->default('');
            $table->string('apellido_materno', 250)->nullable()->default('');
            $table->date('fecha_nac')->nullable();
            $table->date('fecha_reg')->nullable();
            $table->string('hora_reg', 100)->nullable()->default('');
            $table->string('tipo_visita', 100)->nullable()->default('');
            
            $table->string('sexo', 100)->nullable()->default('');
            $table->string('origen', 150)->nullable()->default('');
            $table->string('pais', 250)->nullable()->default('');
            $table->string('ciudad', 250)->nullable()->default('');
            $table->string('tiempo_permanencia', 250)->nullable()->default('');
            $table->string('medio_viaje', 250)->nullable()->default('');

            $table->string('user_register', 150)->nullable()->default('');
            $table->string('user_update', 150)->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
