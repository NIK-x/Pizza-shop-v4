<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ingredients')) {
            Schema::create('ingredients', function (Blueprint $table) {
                $table->id('id_ingredients');
                $table->string('ingredients_name', 100);
                $table->decimal('ingredients_price', 8, 2);
                $table->string('ingredients_image');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};