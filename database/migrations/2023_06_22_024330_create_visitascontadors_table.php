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
        Schema::create('visitascontadors', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->default(0);
            $table->string('sexo', 100)->nullable()->default('');
            $table->string('origen', 100)->nullable()->default('');
            $table->string('etapa_vida', 100)->nullable()->default('');
            $table->date('fecha_reg')->nullable();
            $table->string('hora_reg', 100)->nullable()->default('');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitascontadors');
    }
};
