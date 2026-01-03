<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('pizza_id')->constrained('pizzas', 'pizza_id')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes', 'id_sizes')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->json('extra_ingredients')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->string('session_id')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};