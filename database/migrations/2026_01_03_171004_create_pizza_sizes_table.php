<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pizza_sizes')) {
            Schema::create('pizza_sizes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pizza_id');
                $table->unsignedBigInteger('size_id');
                $table->decimal('price', 8, 2);
                
                $table->foreign('pizza_id')
                      ->references('pizza_id')
                      ->on('pizzas')
                      ->onDelete('cascade');
                      
                $table->foreign('size_id')
                      ->references('id_sizes')
                      ->on('sizes')
                      ->onDelete('cascade');
                
                $table->unique(['pizza_id', 'size_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pizza_sizes');
    }
};