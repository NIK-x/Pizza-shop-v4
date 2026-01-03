<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pizzas')) {
            Schema::create('pizzas', function (Blueprint $table) {
                $table->id('pizza_id');
                $table->string('pizza_name', 100);
                $table->text('pizza_description');
                $table->decimal('pizza_price', 8, 2)->default(0);
                $table->string('pizza_image');
                $table->boolean('pizza_popular')->default(false);
                $table->unsignedBigInteger('category_id');
                
                $table->foreign('category_id')
                      ->references('category_id')
                      ->on('categories')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};