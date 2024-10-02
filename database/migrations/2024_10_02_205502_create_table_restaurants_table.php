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
        Schema::create('table_restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pointdevente_id');
            $table->string('numero_table');
            $table->string('qr_code')->nullable();
            // $table->boolean('disponible')->default(1);
            $table->foreign('pointdevente_id')->references('id')->on('pointde_ventes')->cascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_restaurants');
    }
};
