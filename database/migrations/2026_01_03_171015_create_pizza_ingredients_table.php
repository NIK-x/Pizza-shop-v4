<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pizza_ingredients')) {
            Schema::create('pizza_ingredients', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pizza_id');
                $table->unsignedBigInteger('ingredient_id');
                $table->boolean('is_base')->default(false);
                
                $table->foreign('pizza_id')
                      ->references('pizza_id')
                      ->on('pizzas')
                      ->onDelete('cascade');
                      
                $table->foreign('ingredient_id')
                      ->references('id_ingredients')
                      ->on('ingredients')
                      ->onDelete('cascade');
                
                $table->unique(['pizza_id', 'ingredient_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pizza_ingredients');
    }
};