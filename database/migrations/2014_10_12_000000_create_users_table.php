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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->unsignedBigInteger('pointdevente_id')->nullable();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('type')->default(0);
            /* Admin: 0=>Admin, 1=>AdminResto, 2=>Manager, 3=>cuisinier */
            $table->string('password');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->cascade('delete');
            $table->foreign('pointdevente_id')->references('id')->on('pointde_ventes')->cascade('delete');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
