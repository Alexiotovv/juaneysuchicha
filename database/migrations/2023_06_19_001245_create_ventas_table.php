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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('user', 250)->nullable()->default('');
            // $table->string('nro_stand', 100)->nullable()->default('');
            // $table->string('procedencia', 250)->nullable()->default('');
            // $table->string('linea_artesanal', 250)->nullable()->default('');
            $table->decimal('cantidad', 8, 2)->nullable()->default(1);
            $table->date('fecha')->nullable();
            $table->decimal('precio_venta', 8, 2)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
