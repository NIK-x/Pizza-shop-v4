<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('sizes')) {
            Schema::create('sizes', function (Blueprint $table) {
                $table->id('id_sizes');
                $table->string('size_name', 20);
                $table->integer('size_diameter');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};