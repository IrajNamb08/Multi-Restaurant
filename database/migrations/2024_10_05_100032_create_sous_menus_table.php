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
        Schema::create('sous_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('nom_sous_menu');
            $table->decimal('prix',12,2);
            $table->text('description');
            $table->string('image_sous_menu');
            $table->boolean('disponibilite')->default(1);
            $table->foreign('menu_id')->references('id')->on('menus')->cascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_menus');
    }
};
